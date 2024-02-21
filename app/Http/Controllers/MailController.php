<?php

namespace App\Http\Controllers;
use App\Models\Books;
use App\Models\User;
use App\Models\Activities;
use App\Models\Notification;
use App\Mail\book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function sendDownloadMail($id){
        $book=Books::where('id','=',$id)->with('user')->get();

        $increase=$book[0]['num_download']+1;

        $change=Books::where('id','=',$id)->with('user');

        $change->update([
           'num_download'=>$increase,
        ]);

        $data=[
         'subject'=> $book[0]['title']." Book Was Downloaded",
         'title'=>$book[0]['title'],
         'author'=>$book[0]['author'],
         'price'=>$book[0]['price'],
         'id'=>$book[0]['id'],
         'name'=>auth()->user()['name'],
         'email'=>auth()->user()['email'],
         'solds'=>$increase,
        ];


         Mail::to('okoloemeka47@gmail.com')->send(new book($data));

         // sending mail to admin
         Mail::to('okoloeka37@gmail.com')->send(new book($data));

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
            'book_id'=>$book[0]['id'],
            'description'=>"Someone Bought Your Book",
            'status'=>"unchecked",
            'type'=>'Download',
            'for_text'=>'Book',
            'book_title'=>$book[0]['title'],
    ]);

        
         return view('all.book',['book'=>$book,'message'=>'Transaction sucessfull']);
    }
}
