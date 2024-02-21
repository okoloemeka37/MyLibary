<?php use Illuminate\Support\Carbon;?>
<?php
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip= $_SERVER['HTTP_CLIENT_IP']; 
        }
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip= $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if (!empty($_SERVER['HTTP_X_REAL_IP'])){
            $ip= $_SERVER['HTTP_X_REAL_IP'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        $ip='102.88.82.153';
      
        $ip_data=@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));


$currency=$ip_data->geoplugin_currencyCode;

?>
@extends('../layouts.head')
@vite( ['resources/sass/app.scss','resources/js/comment&ratings.js'])



    <title>{{$book[0]['title']}}</title>
   <style>
      
        section {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
.fa-solid,.fa-star-half-stroke{
    color: red;
}
.report{
    border: 1px solid rgb(189, 189, 189);
    background-color: rgb(230, 230, 230);
    width: fit-content;
   margin-left: 77%;
   padding: 3px;
   margin-top: 20px;

}
.let{
    background-color: #1286e4;
width: fit-content;
padding: 5px;
margin-top: 10%;
margin-left:45% ;
}
    </style>
</head>
<script defer>
function change(price,dom,state) {
    
    let id="93be5a7561d547409152e8cc5ff50773";
let newState=document.querySelector(".cur").getAttribute('type');


    const options = {method: 'GET', headers: {accept: 'application/json'}};
fetch(`https://openexchangerates.org/api/latest.json?app_id=${id}`, options)
  .then(response => response.json())
  .then(response =>{
    let bookOriginalRate=Math.ceil(Number(price)/response['rates'][state]);

    let rate=response['rates'][newState];
   
    let changeTo=Math.ceil(Number(bookOriginalRate)*rate);

    let id="#"+"book"+Number(dom).toString();
  
    document.querySelector(id).innerHTML=newState+" "+changeTo;
    
    

  })
  .catch(err => console.error(err));
}
</script>
<body>

    <form action="" method="post" >
        @csrf
    </form>
    <p class="table" name="books"></p>
    <section>





        <div class="alert2 alert-success">
            <p class="check">{{$message}}</p>
        </div>

        @if ($book[0]['user_id']== auth()->user()['id'])

        @else
        @if (session('message'))
        <p class="let blue"> {{session('message')}}</p>
        @else
        <p class="report"><a href="{{route('report_index',['Book',$book[0]['id']])}}">Report This Book</a> </p>

        @endif
       
    @endif

        @foreach ($book as $rt)
        <input type="hidden" class="owner" value={{$rt['user']['id']}}>
        <?php $image="BookImages/".$rt['image'] ?>

<p class="cur" type={{$currency}}></p>
        
        <div class="book-details">
            <img class="book-cover" id="book-cover-image" src="{{ URL::asset($image) }}" alt="Book Cover">
        <?php $date=Carbon::parse($rt['created_at']) ?>
        <h3 class="title">Book Title: <span class="gb"> {{$rt['title']}}</span></h3>
        <p class="author">Author :{{$rt['author']}} (<span>Uploaded by <a href="{{route('sortAuth',$rt->user_id)}}" style="color: red;"> {{$rt->user['name']}}</a></span>)</p>
             <p>Genre: {{$rt['genre']}}</p>
          
            <p>Description: {{$rt['description']}}</p>
            <p>Published Date: {{$date->toFormattedDateString()}}</p>
            <p>ISBN: {{$rt['ISBN']}}</p>

          
            <div class="book-info">
                <h2>Additional Information</h2>
                <p>Pages  <b>:</b> {{$rt['page']}}</p>
                <p>Language  <b>:</b> {{$rt['language']}}</p>
                <p>Format  <b>:</b> {{$rt['hard_copy']}}copy</p>
                <p>Number Of Book Sold  <b>:</b> {{$rt['num_download']}}</p>
                <h3>Price <b>:</b> <span style=" color:skyblue" id=book{{ $rt->id }} > @if($rt['free']==='false')<script>change({{$rt['price']}},{{$rt['id']}},"{{$rt['user']['currency']}}")</script> @else {{"Free" }} @endif ?></span></h3>
                <p>Store Location <b>:</b> @if ($rt['location'] =='')Online Store @else{{$rt['location']}} @endif </p>
            </div>

   @if ($rt['hard_copy']==='soft')
   @if ($rt['free']==='false')

   <form action="{{route('pay')}}" method="post">
@csrf
<input type="hidden" name="amount" value="{{$rt['price']}}">
<input type="hidden" name="id" value="{{$rt['id']}}">
   <button type="submit" class="download-button">Buy Book</button>
   <a href='{{ URL::asset("Books/".$rt['link'] ) }}' class="download-button down" download style="display: none;">Download</a>
</form>
       @else
       <a href='{{route('sdm',$rt['id'])}}' class="download-button">Download</a>
       <a href='{{ URL::asset("Books/".$rt['link']) }}' class="download-button down" download style="visibility: hidden">Download</a>
   @endif
       @else
       <p  class="download-button">Order</p>
   @endif
   
 
        </div>
        <input type="hidden" name="book_id" class="item_id" value="{{$rt['id']}}">
        @endforeach

        <div id="overlay"></div>

<div id="popup-container">
  <h2><i>Thanks For Downloading My Book</i></h2>
  <h4>Your Download will start now</h4>
  <p>Feel free to drop your reactions about the book and also on the comment section, I will appriciate that.
  </p>
    <button class="proceed" style="background-color:rgb(0, 140, 255) ;margin-top:10px;">Proceed</button>
   
</div>


<div class="container">

    <div class="fd">
    <div class="rates">
        <p class="d">Rate This book </p><p class="v">Tell Others What You Think</p>
        <div class="star_holder">
        <i class="fa-regular fa-star star" id=1></i>
        <i class="fa-regular fa-star star" id=2></i>
        <i class="fa-regular fa-star star" id=3></i>
        <i class="fa-regular fa-star star" id=4></i>
        <i class="fa-regular fa-star star" id=5></i>
    </div>
    </div>

   
      
    <div class="ratings">
        <h3>Ratings</h3>
        <div class="nv">
            <p class="num_rates" >0</p>
            <i class="fa-regular fa-star" id="h1"></i>
            <i class="fa-regular fa-star" id="h2"></i>
            <i class="fa-regular fa-star" id=h3></i>
            <i class="fa-regular fa-star"id=h4></i>
            <i class="fa-regular fa-star"id=h5></i>
            <small class="num_raters">0</small>
        </div>
    
    </div>

</div>
    <div class="comment-form">
        <textarea placeholder="Write your comment..." name="content" class="content">{{old('content')}}</textarea>
        <input type="hidden" class="parent_id" value="0">
        <p class="com_err text-error"></p>      
        <input type="hidden" class="ed_id" value=''>
       
        <button type="submit" class="Add_comment">Add Comment</button>
        <button type="submit" class="edit_comment" style="display: none;">Edit Comment</button>
    </div>
    <br>
    <h2>Reviews</h2>
   


    <div class="comments"></div>

</div>

 
   
</div>
    </section>



    <footer>
        &copy; 2023 Bookstore App
    </footer>



    <script>
        
   
    </script>

</body>
</html>
