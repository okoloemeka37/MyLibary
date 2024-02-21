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

$country=$ip_data->geoplugin_countryName;
$currency=$ip_data->geoplugin_currencyCode;

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
    <div class="registration-container reg">
        <h2>User Registration</h2>
        <div class="registration-buttons">
            <button type="submit" class="register-user active" id="norm">Register as User</button>
            <button type="submit" class="register-author" id="author">Register as Author</button>
        </div>
        <div class="normal_form">
        <form method="POST" enctype="multipart/form-data" action="{{route('register_handle')}}">
            @csrf
            <img src="" alt="" class="prev">
            <label for="username">Username:</label>
            <input type="text" id="username" name="name" @error('name') style=" border: 1px solid #ff0000;" @enderror value="{{old('name')}}">
            @error('name')<p class="text-danger">{{$message}} </p>@enderror

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" ; @error('email') style=" border: 1px solid #ff0000;" @enderror value="{{old('email')}}">
            @error('email')<p class="text-danger">{{$message}} </p>@enderror

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" @error('password') style=" border: 1px solid #ff0000;" @enderror >
            @error('password')<p class="text-danger">{{$message}} </p>@enderror

           
            <span class="image_fake_btn faker" >Choose Image</span>
            @error('image')<p class="text-danger">
                {{$message}}  
            </p>
            @enderror

            <input type="hidden" name="country" value="{{$country}}">
            <input type="hidden" name="currency" value="{{$currency}}">
            <button type="submit" class="signup">Register</button>
            <input type="file" name="image" accept=".jpg,.jpeg,.png" class="image_input">
        </form>
        </div>





        <div class="author_form">
            <form method="POST" enctype="multipart/form-data" action="{{route('register_handle_author')}}">
                @csrf
                <img src="" alt="" id="Aprev">
                <label for="username">Username:</label>
                <input type="text" id="username" name="Aname" @error('Aname') style=" border: 1px solid #ff0000;" @enderror value="{{old('Aname')}}">
                @error('Aname')<p class="Atext-danger">The Name Field Is Required</p>@enderror
    
                <label for="email">Email:</label>
                <input type="email"  name="Aemail" ; @error('Aemail') style=" border: 1px solid #ff0000;" @enderror value="{{old('Aemail')}}">
                @error('Aemail')<p class="Atext-danger">The Email Field Is Required</p>@enderror
    
                <label for="author_description">Author Description:</label>
                <textarea name="author_description" id="" cols="47" rows="10"@error('author_description') style=" border: 1px solid #ff0000;" @enderror >{{old('author_description')}}</textarea>
                @error('author_description')<p class="Atext-danger">{{$message}} </p>@enderror
    

                <label for="number">Phone Number:</label>
                <input type="text" id="p" name="phone" ; @error('phone') style=" border: 1px solid #ff0000;" @enderror value="{{old('phone')}}" >
                @error('phone')<p class="Atext-danger">{{$message}} </p>@enderror
    
                <label for="fb_link">Facebook link:</label>
                <input type="url" id="fb_link" name="fb_link" ; @error('fb_link') style=" border: 1px solid #ff0000;" @enderror value="{{old('fb_link')}}">
                @error('fb_link')<p class="Atext-danger"> The Facebook Field Is Required </p>@enderror
    
                <label for="ig_link">Instagram link:</label>
                <input type="url" id="ig_link" name="ig_link" ; @error('ig_link') style=" border: 1px solid #ff0000;" @enderror value="{{old('ig_link')}}">
                @error('ig_link')<p class="Atext-danger">The Instagram Field Is Required</p>@enderror
    
                <label for="twitter_link">Twitter link:</label>
                <input type="url" id="twitter_link" name="twitter_link" ; @error('twitter_link') style=" border: 1px solid #ff0000;" @enderror value="{{old('twitter_link')}}">
                @error('twitter_link')<p class="Atext-danger">{{$message}} </p>@enderror
    


                <label for="password">Password:</label>
                <input type="password" name="Apassword" @error('Apassword') style=" border: 1px solid #ff0000;" @enderror >
                @error('Apassword')<p class="Atext-danger">{{$message}} </p>@enderror
    
               
                <span class="image_fake_btn " id="Afaker">Choose Image</span>
                @error('Aimage')<p class="Atext-danger">
                  The Image Field Is Required
                </p>
                @enderror
    
                <button type="submit" class="signup" id="f">Register</button>
                <input type="file" name="Aimage" accept=".jpg,.jpeg,.png" id="Aimage_input">

                <input type="hidden" name="country" value="{{$country}}">
                <input type="hidden" name="currency" value="{{$currency}}">
            </form>
            </div>
        <div class="login-link">
            Already have an account? <a href="{{route('login')}}">Login here</a>
        </div>
    
    
  
       
    </div>



 

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
