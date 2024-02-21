<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\password_reset_tokens;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Mail\signup;
use App\Mail\password_reset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{




    //getting users location with ip address




    function register_normal(Request $request)  {

        

       $credentials=$request->validate([
        'name'=>['required','string'],
        'email'=>['required','email','unique:users,email'],
        'password'=>['required', Password::min(8)->letters()->symbols()],
        'image'=>['required','image','max:500'],
       ]);

    

       
       $imageName = time().'.'.$request->image->extension();
       User::create([
            'name'=>$credentials['name'],
            'email'=> $credentials['email'],
            'password'=>bcrypt($credentials['password']),
            'image'=> $imageName,
            'role'=>'norm',
            'phone'=>' ',
            'ig_link'=>' ',
            'fb_link'=>' ',
            'twitter_link'=>' ',
            'author_description'=>' ',
            'country'=>$request['country'],
            'currency'=>$request['currency'],  
            'liked_genres'=>json_encode(['Romance']),
            'liked_topics'=>json_encode(['Romance']),
               ]);

       // Public Folder
     $request->image->move(public_path('uploaded'), $imageName);

     //$this->dropbox->upload('/path/to/dropbox/zylet/' . $imageName, file_get_contents($file));
      

       Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);

       // Redirect to the dashboard or any other desired page
      $data=[
        'name'=>$credentials['name']
      ];
       Mail::to($credentials['email'])->send(new signup($data));
        return redirect()->route('NormDashboard'); 
       
       
    }



    function register_author(Request $request)  {
        
        $credentials=$request->validate([
         'Aname'=>['required','string'],
         'Aemail'=>['required','email','unique:users,email'],
         'Apassword'=>['required', Password::min(8)->letters()->symbols()],
         'Aimage'=>['required','image','max:500'],
         'phone'=>['required','regex:/^[0-9]+$/','max:9999999999'],
         'ig_link'=>['required','url'],
         'fb_link'=>['required','url'],
         'twitter_link'=>['required','url'],
         'author_description'=>['required','string']
        ]);
        
        $imageName = time().'.'.$request->Aimage->extension();
        $data=[
            'name'=>$credentials['Aname']
          ];
           Mail::to($credentials['Aemail'])->send(new signup($data));
           
        User::create([
             'name'=>$credentials['Aname'],
             'email'=> $credentials['Aemail'],
             'password'=>bcrypt($credentials['Apassword']),
             'image'=> $imageName,
             'role'=>'Author',
             'phone'=>$credentials['phone'],
             'ig_link'=>$credentials['ig_link'],
             'fb_link'=>$credentials['fb_link'],
             'twitter_link'=>$credentials['twitter_link'],
             'author_description'=>$credentials['author_description'],
             'country'=>$request['country'],
            'currency'=>$request['currency'],
            'liked_genres'=>json_encode(['Romance']),
            'liked_topics'=>json_encode(['Romance']),
        ]);
 
        // Public Folder
        $request->Aimage->move(public_path('uploaded'), $imageName);
       
 
        Auth::attempt(['email' => $credentials['Aemail'], 'password' => $credentials['Apassword']]);
 
        // Redirect to the dashboard or any other desired page
       
      
         return redirect()->route('AuthorDashboard');
        
        
     }
 



    function login(Request $request) {
        $credentials=$request->validate([
            
            'email'=>['required','email','exists:users,email'],
            'password'=>['required'],
           ]);
           if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])){
          return redirect()->intended('/');
           }else{
            return redirect()->back()->with(['error'=>"Wrong Credentials"]);
           }
           
    }
   

function logout(){
Auth::logout();
return redirect()->route("login");

}
//becoming an author

function BeAuthShow(){
    return view('user.becomeAuthor');
}
function BeAuthHandle(Request $request, $id){
    $user=User::find($id);
$credentials=$request->validate([
    'phone'=>['required','regex:/^[0-9]+$/','max:9999999999'],
         'ig_link'=>['required','url'],
         'fb_link'=>['required','url'],
         'twitter_link'=>['required','url'],
         'author_description'=>['required','string']
]);
$user->update([
    'role'=>'Author',
    'phone'=>$credentials['phone'],
    'ig_link'=>$credentials['ig_link'],
    'fb_link'=>$credentials['fb_link'],
    'twitter_link'=>$credentials['twitter_link'],
    'author_description'=>$credentials['author_description'],
]);
$data=[
    'name'=>auth()->user()->name
  ];
   Mail::to(auth()->user()->email)->send(new signup($data));
return redirect()->route('AuthorDashboard');

}

//edit user

function edit(Request $request, $id){
$user=User::find($id);
$credentials=$request->validate([
    'name'=>['required','string'],
    'email'=>['required','email'],
    'image'=>['nullable','image','max:500'],
    'phone'=>['required','regex:/^[0-9]+$/','max:9999999999'],
    'ig_link'=>['required','url'],
    'fb_link'=>['required','url'],
    'twitter_link'=>['required','url'],
    'author_description'=>['required','string']
   ]);
   

  

   if($request->image === NULL){
$imageName=$request['old-img'];
   }else{
    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('uploaded'), $imageName);
    //remove old image
    unlink(public_path("uploaded/".$request['old-img']));
   }

  $user->update([
        'name'=>$credentials['name'],
        'email'=> $credentials['email'],
        'password'=>auth()->user()->password,
        'image'=> $imageName,
        'role'=>auth()->user()->role,
        'phone'=>$credentials['phone'],
        'ig_link'=>$credentials['ig_link'],
        'fb_link'=>$credentials['fb_link'],
        'twitter_link'=>$credentials['twitter_link'],
        'author_description'=>$credentials['author_description'],
        'country'=>$request['country'],
       'currency'=>$request['currency'],
   ]);

   // Public Folder
  
  

   

   // Redirect to the dashboard or any other desired page
  

   if(auth()->user()->id ===1){
    return redirect()->route('dashboard')->with('success', 'rofile Changed Successfully.');
   }else{
    return redirect()->route('AuthorDashboard')->with('success', 'Profile Changed Successfully.');
   }


}

function codeSend(){
   
$code_arr=[];
    while(count($code_arr)<5){
       $codes=rand(0,9);  
       array_push($code_arr,$codes);
    }
    $token=implode('',$code_arr);
    password_reset_tokens::create([
        'email'=>auth()->user()->email,
        'token'=>$token,
    ]);
    
    $data=[
        'name'=>auth()->user()['name'],
        'token'=>$token
      ];
       Mail::to(auth()->user()['email'])->send(new password_reset($data));
    return view("all.confirm");
}

function codeCheck(Request $request){

    $data=$request->validate([
        'token'=>["required"]
    ]);

$check=password_reset_tokens::where('email','=',auth()->user()->email)->get();

        if($check[0]['token']===$data['token']){
           return redirect()->route("pass_view",['token'=>$data['token']]);
        }else{
            return redirect()->back()->with(['message'=>"Wrong Code"]);
        }
}

function pass_view($token){
    $check=password_reset_tokens::where('email','=',auth()->user()->email)->get();
    if(count($check) !=0){
    if($check[0]['token']===$token){
        return view("Auths.pass_change",['token'=>$token]);
     }else{
        return redirect()->route("home");
     }}else{
        return redirect()->route("home");
     }
   
}

function password_change(Request $request){
    $data=$request->validate([
        'password'=>['required',Password::min(8)->letters()->symbols(),'confirmed']
    ]);
    $user=User::find(auth()->user()->id);
    $user->update([
        'password'=>bcrypt($data['password'])
    ]);
    password_reset_tokens::where('email','=',auth()->user()->email)->delete();
    if(auth()->user()->id ===1){
        return redirect()->route('dashboard')->with('success', 'rofile Changed Successfully.');
       }else{
        return redirect()->route('AuthorDashboard')->with('success', 'Profile Changed Successfully.');
       }
}
}
