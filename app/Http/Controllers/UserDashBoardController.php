<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashBoardController extends Controller
{
    function show(){
      $user=auth()->user();
        $post=Posts::where("user_id", '=',$user->id)->count();
        $book=Books::where("user_id", '=',$user->id)->count();
     
        return    view('user.dashboard',['post'=>$post,'book'=>$book]);
    }

    function Normshow(){
      $user=auth()->user();
        $post=Posts::where("user_id", '=',$user->id)->count();
        $book=Books::where("user_id", '=',$user->id)->count();
     
        return    view('normal.dashboard',['post'=>$post,'book'=>$book]);
    }
   
  
}
