<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    function all(){
        $id=auth()->user()->id;
        $notice=Notification::where('user_id','=',$id)->orderBy("id",'desc')->get();
        
       
       $user_id= $notice[0]['user_id'];

        $from=User::where('id','=',$user_id)->orderBy("id",'desc')->get();
      
        return view('all.Notification',['notice'=>$notice,'user'=>$from]);
    }


    //checking notification

    function check($id){
$note=Notification::find($id);
$note->update(["status"=>"checked"]);
    }
    
}
