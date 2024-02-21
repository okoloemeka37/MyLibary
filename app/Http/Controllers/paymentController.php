<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\User;
use App\Models\Activities;
use App\Models\Notification;
use App\Mail\book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;
use App\Models\Books;



class paymentController extends Controller
{
    private $gateway;
  public function __construct(){
    $this->gateway= Omnipay::create('PayPal_rest');
    $this->gateway->setClientId(env("PAYPAL_CLIENT_ID"));
    $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
    $this->gateway->setTestMode(true);
   }

   public function pay(Request $request){
    $id=$request->id;
        try{
            $response=$this->gateway->purchase([
                'amount'=>$request->amount,
                'currency'=>env('PAYPAL_CURRENCY'),
                'returnUrl'=>route('ret',$id),
                'cancelUrl'=>url("error")
            ])->send();

            if($response->isRedirect()){
                    $response->redirect();
            }else{
                return $response->getMessage() ."ee";
            }

        }catch(\Throwable $th){
            return $th->getMessage()."tr";
        }

   }

   public function success(Request $request, $id){

        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction=$this->gateway->completePurchase([
                'payer_id'=>$request->input('PayerID'),
                'transactionReference'=>$request->input('paymentId'),
            ]);

                $response=$transaction->send();

             if($response->isSuccessful()){
                    $arr=$response->getData();

                    payment::create([
                        'payer_id'=>$arr['payer']['payer_info']['payer_id'],
                        'payment_id'=>$arr['id'],
                        'payer_email'=>$arr['payer']['payer_info']['email'],
                        'status'=>$arr['state'],
                        'amount'=>$arr['transactions'][0]['amount']['total'],
                        'currency'=>env('PAYPAL_CURRENCY')
                    ]);
                   $book=Books::where('id','=',$id)->with('user')->get();

                   $increase=$book[0]['num_download']+1;

                   $change=Books::where('id','=',$id)->with('user');

                   $change->update([
                      'num_download'=>$increase,
                   ]);

                   $data=[
                    'subject'=>$book[0]['title']." Book Was Downloaded",
                    'title'=>$book[0]['title'],
                    'author'=>$book[0]['author'],
                    'price'=>$book[0]['price'],
                    'id'=>$book[0]['id'],
                    'name'=>auth()->user()['name'],
                    'email'=>auth()->user()['email'],
                    'solds'=>$increase,
                   ];
                    Mail::to($book[0]['user']['email'])->send(new book($data));
                    // sending mail to admin
                    Mail::to('okoloemeka37@gmail.com')->send(new book($data));
                    //noting activity
                    Activities::create([
                        'act_id'=>$book[0]['id'],
                        'act'=>"Downloaded A Book"
                    ]);
                 

                    
        $lastGenre=json_decode(auth()->user()->liked_genres);
        $dt=0 ;
            for($i=0;$i <count($lastGenre); $i++){
              $red=$lastGenre[$i];
              if($red===$book[0]['genre']){
                $dt=1;
              }
            }
  
            if($dt !=1){
          $user= User::where('id','=',auth()->user()->id);
  
          array_push($lastGenre,$book[0]['genre']);
          $user->update([
            'liked_genres'=>json_encode($lastGenre),
           ]);
          }

          

                   //sending notification to the owner of book
                  
                            Notification::create([
                                'from_id'=>auth()->user()->id,
                                'user_id'=>$book[0]['user']['id'],
                                'item_id'=>$book[0]['id'],
                                'description'=>"Someone Bought Your Book",
                                'status'=>"unchecked",
                                'type'=>'Download',
                                'for_text'=>'Book',
                                'item_title'=>$book[0]['title'],
                        ]);



                    return view('all.book',['book'=>$book,'message'=>'Transaction sucessfull']);
             }   else{
                return $response->getMessage();
             }
        }else{
            return 'Payment Declined';
        }


   }

   public function error(){
    return 'User Declined Payment';
   }
}

