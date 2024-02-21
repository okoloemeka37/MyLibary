<?php

namespace App\Http\Controllers;

use App\Models\ratings;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    function add(Request $request){
        $data=$request->validate([
           
            'book_id'=>'required',
            'rate'=>'required',
           
        ]);
        $rates=ratings::where("book_id",'=',$data['book_id'])->where("user_id",auth()->user()->id)->get();
echo $rates;
        if(count($rates)===0){
            ratings::create([
                'user_id'=>auth()->user()->id,
                'book_id'=>$data['book_id'],
                'rate'=>$data['rate'],
            ]);
        }else{
            $rating=ratings::where("book_id",'=',$data['book_id'])->where("user_id",auth()->user()->id);
            $rating->update([
                'rate'=>$data['rate'],
            ]);
        }
       
    }

    function p_rating($id){
        $rates=ratings::where("book_id",'=',$id)->where("user_id",auth()->user()->id)->get();
        return response()->json(["rating"=>$rates]);
    }

    function other_rating($id){
        $rates=ratings::where("book_id",'=',$id)->get();
        return response()->json(["rating"=>$rates]);
    }

}
