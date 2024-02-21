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

$country='$ip_data->geoplugin_countryName';
$currency='$ip_data->geoplugin_currencyCode';

?>

@extends('layouts.head')


<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
      
    }
</style>
    @vite( ['resources/sass/app.scss'])
  

</head>
<body>
    <?php
    $user=auth()->user();
  $image="uploaded/".$user->image;
  ?>
    @section('content')
    <div class="registration-container reg">
        <h2>Edit Profile</h2>
       
        <div>
        <form method="POST" enctype="multipart/form-data" action="{{route('editProfile_handle',$user->id)}}">
            @csrf
            @method('PUT')
            <img src="{{URL::asset($image)}}" alt="" class="prev" style="display:inline-block"> <i class="fa-solid fa-pencil faker"></i>
            @error('image')<p class="text-danger">{{$message}}</p>@enderror

<input type="hidden" name="old-img" value="{{$user->image}}">

            <label for="username">Username:</label>
            <input type="text" id="username" name="name" @error('name') style=" border: 1px solid #ff0000;" @enderror value="{{$user->name}}">
            @error('name')<p class="text-danger">{{$message}} </p>@enderror

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" ; @error('email') style=" border: 1px solid #ff0000;" @enderror value="{{$user->email}}">
            @error('email')<p class="text-danger">{{$message}} </p>@enderror


           
          

            
            <label for="author_description">Author Description:</label>
            <textarea name="author_description" id="" cols="47" rows="5"@error('author_description') style=" border: 1px solid #ff0000;" @enderror >{{$user->author_description}}</textarea>
            @error('author_description')<p class="Atext-danger">{{$message}} </p>@enderror


            <label for="number">Phone Number:</label>
            <input type="text" id="p" name="phone" ; @error('phone') style=" border: 1px solid #ff0000;" @enderror value="{{$user->phone}}" >
            @error('phone')<p class="text-danger">{{$message}} </p>@enderror

            <label for="fb_link">Facebook link:</label>
            <input type="url" id="fb_link" name="fb_link" ; @error('fb_link') style=" border: 1px solid #ff0000;" @enderror value="{{$user->fb_link}}">
            @error('fb_link')<p class="text-danger"> The Facebook Field Is Required </p>@enderror

            <label for="ig_link">Instagram link:</label>
            <input type="url" id="ig_link" name="ig_link" ; @error('ig_link') style=" border: 1px solid #ff0000;" @enderror value="{{$user->ig_link}}">
            @error('ig_link')<p class="text-danger">The Instagram Field Is Required</p>@enderror

            <label for="twitter_link">Twitter link:</label>
            <input type="url" id="twitter_link" name="twitter_link" ; @error('twitter_link') style=" border: 1px solid #ff0000;" @enderror value="{{$user->twitter_link}}">
            @error('twitter_link')<p class="text-danger">{{$message}} </p>@enderror

            <input type="hidden" name="country" value="{{$country}}">
            <input type="hidden" name="currency" value="{{$currency}}">
            <button type="submit" class="signup">Edit</button>
            <input type="file" name="image" accept=".jpg,.jpeg,.png" class="image_input">
        </form>
        </div>
       
    </div>

@endsection

 

    <script type="module">

let phone=document.querySelector("#p")
phone.addEventListener('input',()=>{
if (phone.value.length > 11) {
    phone.value=phone.value.slice(0,11)
}
})

import  {imagePreviewer}  from  "{{ asset('script/function.js')}}";



     let faker=document.querySelector(".faker");
        let input=document.querySelector(".image_input")
        let previewer=document.querySelector(".prev")
        imagePreviewer(faker,previewer,input);

        let Afaker=document.querySelector("#Afaker");
        let Ainput=document.querySelector("#Aimage_input")
        let Apreviewer=document.querySelector("#Aprev")
        imagePreviewer(Afaker,Apreviewer,Ainput);


        //switching forms;
        let author=document.querySelector("#author");
        let norm=document.querySelector("#norm");


        author.addEventListener("click",()=>{
document.querySelector('.normal_form').style.display='none';
document.querySelector('.author_form').style.display='block';
author.classList.add('active');
norm.classList.remove('active');
        })

        
        norm.addEventListener("click",()=>{
document.querySelector('.normal_form').style.display='block';
document.querySelector('.author_form').style.display='none';
author.classList.remove('active');
norm.classList.add('active');
        })


        //showing the needed form

        let Aerrs=document.querySelectorAll(".Atext-danger")
        Aerrs.forEach(ele => {
            if (ele.innerHTML.length>1) {
                document.querySelector('.normal_form').style.display='none';
document.querySelector('.author_form').style.display='block';
author.classList.add('active');
norm.classList.remove('active');
            }
        });
    </script>


</body>
</html>
