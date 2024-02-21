<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\addPost;
use Illuminate\Support\Facades\Mail;
class PostsController extends Controller
{
   function allArticle(){
    $posts=Posts::with('user')->orderBy('id','desc')->get();
    return view('blog.allpost',['posts'=>$posts]);
   }


  


   function owner(){
      $posts=Posts::where('user_id','=',auth()->user()->id)->orderBy('id','desc')->get();
      return view('user.post',['posts'=>$posts]);
     }

   function indPost($id){
      $post=Posts::find($id);
      $new=$post['views'] + 1;
      $post->update([
      'views'=> $new
      ]);
      return view('blog.indPost',['articles'=>$post]);
   }
   function handlePost(Request $request){
      $data=$request->validate([
         'title'=>['required',],
         'slug'=>['required'],
         'content'=>['required'],
         'tag'=>['required'],
         'image'=>'required|image','max:500',
      ]);
         $imageName=time().".".$data['image']->extension();
      Posts::create([
         'title'=>$data['title'],
         'slug'=>$data['slug'],
         'content'=>$data['content'],
         'image'=>$imageName,
         'user_id'=>auth()->user()->id,
         'tag'=>$data['tag'],
         'num_comments'=>0,
         'views'=>0
      ]);

      $data['image']->move(public_path("postImages"),$imageName);

      $us=User::where("liked_topics",'!=','')->get();
      //mail admin
      Mail::to('okoloemeka37@gmail.com')->send(new addPost($data));


      foreach($us as $user){
      
$likes=json_decode($user['liked_topics']);
if(in_array($request->genre,$likes)){
   //mail interested user
   Mail::to('okoloemeka37@gmail.com')->send(new addPost($data));
}

      }


      if(auth()->user()->id === 1){
         return redirect()->route('AdminBooks')->with('success', 'Book Added successfully.');
        }else{
         return redirect()->route('Authorbook')->with('success', 'Book Added successfully.');
        }

   }

   function editPost($id) {
      $post=Posts::find($id);
      return view('blog/edit',['post'=>$post]);
   }
 function ck_upload(Request $request){

      if ($request->hasFile('upload')) {
         $imageName=time().".".$request->file('upload')->extension();
         $request->file('upload')->move(public_path("postImages"),$imageName);

         $url=asset('postImages/'.$imageName);
         return response()->json(['fileName'=>$imageName,'uploaded'=>1,'url'=>$url]);

      }


 }

 function updatepost(Request $request, $id){
   $data=$request->validate([
      'title'=>['required',],
      'slug'=>['required'],
      'content'=>['required'],
      'tag'=>['required'],
      'image'=>'nullable|image|max:500',
   ]);
$image='';
   
   if($request->image=== NULL){
      $image=$request["old-image"];
      
              }
              else{
                  $image=time().'.'.$request->image->extension();
                  $request->image->move(public_path("postImages"),$image);
      
                  //removing existing image
                  $oldimage=public_path("postImages/".$request["old-image"]);
                  //unlink($oldimage);
        
              }

              $post=Posts::find($id);
              $post->update([


               'title'=>$data['title'],
               'slug'=>$data['slug'],
               'content'=>$data['content'],
               'image'=>$image,
              
               'tag'=>$data['tag'],


              ]);
              return view('blog.indPost',['articles'=>$post]);
 }




 //deleting post by author

 function Authordelete(Request $request){
   $post=Posts::find($request->id);

   if ($post['user']['id']===auth()->user()->id) {
      $imageName=$post['image'];
      $post->forceDelete();
      unlink(public_path('postImages/'.$imageName));
      return response()->json(['message'=>'Book Deleted successfully.']);
     
   }else{
      return response()->json(['message'=>'You Are Not Authorize']);
   }
 }


}
