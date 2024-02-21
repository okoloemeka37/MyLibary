<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\Books;
use App\Models\Notification;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashBoardController extends Controller
{
    function show(){
        $user=Auth::user();
        $post=Posts::count();
        $book=Books::count();
        $report=Report::count();
        $norm=User::where("role" ,"!=" ,"Admin")->count();
        $note=Notification::where('user_id','=',$user->id)->where("status" ,"=" ,"unchecked")->count();
        
        return    view('admin.dashboard',['user'=>$user,'post'=>$post,'book'=>$book,'norm'=>$norm,'note'=>$note,'report'=>$report]);
    }
    function users(){
        $user=Auth::user();
       $users=User::where("role" ,"!=" ,"Admin")->withCount('posts')->withCount('books')->get();
      
       
       if($users->count()=== 0){$user=[];}
        return    view('admin.users',['users'=>$users,'user'=>$user]);
    }
    function delete_user($id){
        User::destroy($id);
        //deleting the users book and blogs and notification;
        Books::where('user_id','=',$id)->forceDelete();
       Posts::where('user_id','=',$id)->forceDelete();
       Notification::where('user_id','=',$id)->forceDelete();
        return response()->json(["message"=>"User Deleted"]);
    }
}
