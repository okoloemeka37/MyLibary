<?php

namespace App\Http\Controllers;
use App\Models\Books;
use App\Models\User;
use App\Models\Posts;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    function index ($genre='null'){
       if($genre == 'null'){
        $books=Books::orderBy("id",'desc')->with('user')->paginate(20);
        $genre='All';
       }else{
            $books=Books::where('genre','=',$genre)->orderBy("id",'desc')->with('user')->paginate(20);
       }

       $posts=Posts::with('user')->orderBy('id','desc')->limit('11')->get();
      
    
    return view('welcome',['books'=>$books,'type'=>$genre,'posts'=>$posts]);
    }


    function live(Request $request){
        $value=htmlspecialchars(trim(strip_tags(stripslashes($request->value))));
        $books=Books::where('title','LIKE' ,'%'.$value.'%')
        ->orWhere('author','LIKE' ,'%'.$value.'%')
        ->orWhere('genre','LIKE' ,'%'.$value.'%')
        ->get();
    
        return response()->json(['books'=>$book]);
    }
    function genre($gen){
        $books=Books::where('genre','=',$gen)->orderBy("id",'desc')->paginate(20);
        return  view('ind_genre',['books'=>$books]);
    }

    function sortAuth($id){
        $user=User::where('id','=',$id)->get();
        $books=Books::where('user_id','=',$id)->orderBy("id",'desc')->paginate(20);

        return view('ByName',['books'=>$books,'user'=>$user]);
    }
}
