<?php use Illuminate\Support\Carbon;?>

@extends('all.sideNav')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Notifications</title>
  @vite( ['resources/sass/Admin.scss','resources/js/Admin.js'])

</head>
<style>

  section {
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    color: #3498db;
    margin-bottom: 20px
  }

</style>
<body>
 

<form action="" method="post" >
  @csrf
</form>


  <header>
    <h1>User Notifications</h1>
  </header>
 

  <p class="cu" name="Notification"></p>



  <section>
    <h2>Your Notifications</h2>

@foreach ($notice as $note)
<?php $date=Carbon::parse($note->updated_at)?>


<div class="notification chc @if ($note->status==='unchecked') blue @endif" id="{{$note->id}}" >

 @if ($note->for_text==="books")
  @if ($note->type==="Removed")
  <h3>Your Book, <a href="{{route('s_deleted',$note['item_id'])}}" >"{{$note->item_title}}"</a> was {{$note->type}} by <a href="">{{$user[0]['name']}}</a></h3>

  <p>The Book Will Be Permanently Deleted After 30 Days</p>
  <a href="">click to see details</a>

  @else
  <h3>Your Book, <a href="{{route('sin',$note['item_id'])}}" >"{{$note->item_title}}"</a> was @if ($note->type==='comment') {{$note['description']}} @else {{$note->type}} @endif  by <a href="">{{$user[0]['name']}}</a></h3>

  @endif
  @endif
  
 @if ($note->for_text==="posts")
 @if ($note->type==="Removed")
 <h3>Your Posts, <a href="{{route('s_deleted',$note['item_id'])}}" >"{{$note->item_title}}"</a> was {{$note->type}} by <a href="">{{$user[0]['name']}}</a></h3>

 <p>The Post Will Be Permanently Deleted After 30 Days</p>
 <a href="">click to see details</a>

 @else
 <h3>Your Post, <a href="{{route('indPost',$note['item_id'])}}" >"{{$note->item_title}}"</a> was @if ($note->type==='comment') {{$note['description']}} @else {{$note->type}} @endif  by <a href="">{{$user[0]['name']}}</a></h3>

 @endif
 @endif
 
  <p class="date">Received on:{{$date->toFormattedDateString()}}</p>

</div>
  



@endforeach
    

    <div class="empty-message">
      <p>No new notifications.</p>
    </div>
  </section>
 


  <script>
       let csrf=document.querySelectorAll("input")[0]
       let chc=document.querySelectorAll(".notification");
       chc.forEach(ele => {
      ele.addEventListener('click',()=>{
        let id=ele.id;
        fetch("/check/"+id,{
          method:"GET",
          headers:{
            'Content-Type':"application/json",
                'X-CSRF-TOKEN':csrf.value
          }
        })
        ele.classList.remove('blue')
      })
      
       });
       
  </script>
</body>

</html>
