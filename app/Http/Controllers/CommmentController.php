<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\Books;
use App\Models\Posts;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class CommmentController extends Controller
{
    //

    function save(Request $request){
      
   $data=$request->validate([
    'content'=>'required',
    'item_id'=>'required',
    'parent_id'=>'required',
    'owner_id'=>'required',
    'title'=>'required',
    'table'=>'required'
]);
        comments::create([
            'item_id'=>$data['item_id'],
            'user_id'=>auth()->user()->id,
            'parent_id'=>$data['parent_id'],
            'content'=>$data['content'],
            'c_table'=>$data['table'],

        ]);
        //sending notification to the owner of book
                  
        Notification::create([
            'from_id'=>auth()->user()->id,
            'user_id'=>$data['owner_id'],
            'item_id'=>$data['item_id'],
            'description'=>"Commented On ",
            'status'=>"unchecked",
            'type'=>'comment',
            'for_text'=>$data['table'],
            'item_title'=>$data['title'],
          
    ]);
    //updating either the post or books table in our db

    if($data['table']==='books'){
        $book=Books::find($data['item_id']);
        $new=$book['num_comment'] +1;
        $book->update([
            'num_comments'=>$new
        ]);
    }else if($data['table']==='posts'){
        $post=Posts::find($data['item_id']);
        $new=$post['num_comment'] +1;
        $post->update([
            'num_comments'=>$new
        ]);
    }

    }

    function get(Request $request){
        $id=$request['id'];
        $table=$request['table'];
        $gmt=''; 
        $ngt='';
        $data=comments::where('c_table','=',$table)->where("item_id",'=',$id)->where('parent_id','=',0)->orderBy("id",'DESC')->with('user')->get();
        foreach($data as $dat){
            $rep=comments::where("item_id",'=',$id)->where('parent_id','=',[$dat['id']])->with('user')->get();
            $img=$dat['user']['image'];
        $frt=' <div class="comment">
        <div class="comment-author"><img src="http://127.0.0.1:8000/uploaded/'.$img.' " class="pp" alt="">'. $dat['user']['name'].' </div>
        <div class="comment-body"> <span class="con">'. $dat['content'].'</span></div>
     
        <p class="comment-date">Posted on '. Carbon::parse($dat['created_at'])->toFormattedDateString() .'</p>
         <p class="reply-btn" id="'.$dat['id'].'">Reply</p>';
       
         if (auth()->user()->id == $dat['user_id']) {
        $frt=$frt.  ' <div class="flex">
          <input class="rg" value="'.$dat['content'].'" type="hidden">
           <p class="edit-btn" id="'.$dat['id'].'">Edit</p>
           <p class="delete-btn" id="'.$dat['id'].'">Delete</p>
           </div>';
        
        }else{$frt=$frt. '</div>'; }
         
     
echo $frt;
         foreach($rep as $re){
            
           $mt=$re['user']['image'];
            $gmt='<div class="reply">
            <div class="comment-author"><img src="http://127.0.0.1:8000/uploaded/'.$mt.' " class="pp" alt="">'. $re['user']['name'].' </div>
            <p class="comment-body"><span class="gu">'.$dat["user"]["name"].': </span> <span class="con">'.  $re['content'].'</span></p>
         
            <p class="comment-date">Posted on '. Carbon::parse($re['created_at'])->toFormattedDateString() .'</p>
             <p class="reply-btn" id="'.$dat['id'].'">Reply</p></div>';
             
                if (auth()->user()->id == $re['user_id']) {
                    $gmt=$gmt. ' <div class="flex">
                    <input class="rg" value="'.$re['content'].'" type="hidden">
                     <p class="edit-btn" id="'.$re['id'].'" >Edit</p>
                     <p class="delete-btn" id="'.$re['id'].'">Delete</p>
                     </div>
          
                   </div>';
                }else{$gmt=$gmt. '</div>'; }
  
                        echo $gmt;
         }
 
        }
    }
    function edit(Request $request){
        $data=$request->validate([
            'content'=>'required',
          
            'comment_id'=>'required'
            
        ]);
    $comment=comments::find($data['comment_id']);
    $comment->update([
        
        'content'=>$data['content'],
    ]);
    
    }

    function delete($id){
comments::destroy($id);
comments::where('parent_id','=',$id)->delete();

    }
}

