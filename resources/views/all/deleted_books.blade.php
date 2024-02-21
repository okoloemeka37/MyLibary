<?php use Illuminate\Support\Carbon;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Book Details</title>
    @vite( ['resources/sass/app.scss'])
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .book-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .book-details img {
            max-width: 200px;
            height: auto;
            margin-right: 20px;
        }

        .book-info {
            flex-grow: 1;
            
        }

        .deleted-info {
            margin-top: 20px;display: flex;
        }

        .deleted-info p {
            margin-top: 20px;
            margin-left: 20px;
            font-size: 18px;
        }

        .date-deleted {
            margin-top: 20px;
            color: #888;
        }
        .dr{
            margin-left: 30%;
            margin-top: 10%;
            color: rgb(253, 47, 47);
        }
        .dr span{
            color: rgb(27, 107, 226);
        }
    </style>
</head>
<body>
    
    @foreach ($book as $soft)
    

    <form action="" method="post" >
        @csrf
    </form>




    <?php $image="BookImages/".$soft['image'] ?>
    <div class="container">
        <h1>Deleted Book Details</h1>

        <div class="book-details">
            <img src="{{URL::asset($image)}}" alt="Book Image">
            <div class="book-info">
                <h2>Book Title <b>:</b>  {{$soft['title']}}</h2>
                <p>Author <b>:</b>  {{$soft['author']}}</p>
                <p>Genre  <b>:</b> {{$soft['page']}}</p>
                <p>Pages  <b>:</b> {{$soft['page']}}</p>
                <p>Language  <b>:</b> {{$soft['language']}}</p>
                <p>Format  <b>:</b> {{$soft['hard_copy']}}coy</p>
            </div>
        </div>

        <div class="deleted-info">
            <h3>Reason for Deletion :</h3>
            <p>{{$note[0]['description']}}</p>
        </div>


        <div class="date-deleted">
            <p>Date Created: {{Carbon::parse($soft['created_at']->toFormattedDateString())}}</p>
        </div>
        <p class="dr">This Book Will Be Permanently Deleted After <span>{{30- Carbon::now()->diffInDays(Carbon::parse($soft['deleted_at'])) }} </span>Days</p>
    </div>

    <input type="hidden" class="book_id" value="{{$soft['id']}}">
    @endforeach





    

<div class="container">

    <div class="fd">

      
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
   
    <br>
    <h2>Reviews</h2>
    <div class="comments"></div>

</div>
</div>




<script>
        let csrf=document.querySelectorAll("input")[0]
    get()
function get(params) {
    


    let book_id=document.querySelector(".book_id").value;
fetch('/get_comment/'+book_id,{
    method:"GET",
    headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN':csrf.value
    },

}).then(resp=>resp.text())
.then(data=>{
   
        document.querySelector(".comments").innerHTML=data;
  
})
}


other_rating();

function other_rating(){
    let book_id=document.querySelector(".book_id").value;
    let rates=document.querySelector(".num_rates");
    let raters=document.querySelector(".num_raters");

    fetch("/other_rating/"+book_id,{
        method:"GET",
        headers:{
            'Content-Type':"application/json",
            'X-CSRF-TOKEN':csrf.value
        },
       
    }).then(resp=>resp.json())
    .then(data=>{
      


        raters.innerHTML=data['rating'].length;
        let som=0
        data['rating'].forEach(sot => {
         som += sot['rate'];
         
       if (som>20 && som < 101) {
        if (som <=80) {
           
            document.querySelector("#h1").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
       }}

       if (som>120 && som < 201) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        if (som <=180) {
           
            document.querySelector("#h2").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
       }}

       if (som>220 && som < 301) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
        if (som <=280) {
           
            document.querySelector("#h3").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h3").classList.replace("fa-regular","fa-solid")
       }}

       if (som>320 && som < 480) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h3").classList.replace("fa-regular","fa-solid")
        if (som <=380) {
           
            document.querySelector("#h4").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h4").classList.replace("fa-regular","fa-solid")
       }}
       if (som>520) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h3").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h4").classList.replace("fa-regular","fa-solid")
      
        if (som <=580) {
           
            document.querySelector("#h5").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h5").classList.replace("fa-regular","fa-solid")
       }}




         if (som.toString().length >=4 && som.toString().length <=6) {
            let n_som=(som/1000).toFixed(1);
            rates.innerHTML=n_som+"K"
         }else if(som.toString().length >=6 ){
        rates.innerHTML=som+"M"
         }else{
            rates.innerHTML=som
         }
            
        });
    }) 
}


</script>
</body>
</html>
