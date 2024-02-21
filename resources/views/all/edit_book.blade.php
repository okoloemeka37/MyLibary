<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Edit Form</title>
  <style>
  form {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  
  </style>
</head>
<body>
   
    @vite( ['resources/sass/Admin.scss','resources/js/Admin.js'])
 
    

    <header><h2>EditBook -> {{$book->title}}</h2></header>
    
  <form id="bookForm" method="post" action="{{route("editBook",$book->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="bookName">Book Name:</label>
    <input type="text" class="vb" id="bookName"  name="bookName" value="{{$book->title}}" >

    @error("bookName")
      <p class="text-danger">{{$message}}</p>
    @enderror


    <label for="author">Author:</label>
    <input type="text" class="vb" id="author" name="author" value="{{$book->author}}" >
    @error("author")
    <p class="text-danger">{{$message}}</p>
  @enderror



      <div class="dropDownHolder">
        <label for="genre">Select Genre:</label>
    <input type="text" class="vb" id="genre" name="genre" value="{{$book->genre}}">

    @error('genre')
  <p class="text-danger">    {{$message}}</p>
    @enderror

    <div class="dropsHolder"></div>
      </div>



    <label for="description">Description:</label>
    <textarea class="vb" id="descripti on" name="description" rows="4" >{{$book->description}}</textarea>
    @error("description")
    <p class="text-danger">{{$message}}</p>
  @enderror

    <label for="price">Price :(free <input type="checkbox" @if ($book->free=="true") checked @endif  class="cb" value={{$book->free}}  name="free"  > ) </label>
    <input type="text" class="vb" id="price" name="price" value="{{$book->price}}">
    
    @error("price")
    <p class="text-danger">{{$message}}</p>
  @enderror



  
  <label for="page">Number Of Pages</label>
  <input type="text" class="vb" id="page" name="page" value="{{old('page')}}">
  @error("page")
  <p class="text-danger">{{$message}}</p>
@enderror

<label for="language">Language</label>
<input type="text" class="vb" id="language" name="language" value="{{old('language')}}">
@error("language")
<p class="text-danger">{{$message}}</p>
@enderror

<label for="ISBN">ISBN</label>
<input type="text" class="vb" id="ISBN" name="ISBN" value="{{old('ISBN')}}">
@error("ISBN")
<p class="text-danger">The ISBN field must be a number.</p>
@enderror



    <label for="image">Image: <span class="imgErr" style="color: red;display:none;">Only 5 Images Are Allowed</span></label>
    <?php $img='BookImages/'.$book->image ?>
    <img class="ip" id="iew" src={{URL::asset($img)}} alt="Image Preview">
    <span class="fakebtn aimg">Upload Book Image</span>
    @error("image")
    <p class="text-danger">{{$message}}</p>
  @enderror

  <br>
      
    <input type="radio" id="sc" name="pick" value="soft" @error('book') checked @enderror @if ($book->hard_copy=="soft") checked @endif>Soft copy
    <br>
  
    <br>
    <input type="radio" id="hc" name="pick"  value='hard' @error('location') checked @enderror  @if ($book->hard_copy=="hard") checked @endif>Hard copy
    @error('pick')
   <p class="text-danger">Choose One Option</p> 
  @enderror




    <div id="bolk" class=" @error('book') on @else off @enderror">

          <p >Upload Book Name: <span class="bn"> {{$book->link}}</span></p>
          <span class="fakebtn abook ">Upload Book  </span>
          @error("book")
          <p class="text-danger">Pls Upload A Book</p>
        @enderror

  </div>
  
    <br>

    <div id="locInput" class="@if ($book->hard_copy=="hard") on @else off @endif" >
            <label for="image">Store Location:</label>
            <input type="text" class="vb" id="location" name="location" value="{{$book->location}}">
            @error("location")
            <p class="text-danger" >{{$message}}</p>
          @enderror
    </div>


    <button type="submit" id="upload" class="bk">UpDate Book</button>



    <input type="file" class="ig" id="BookImage" name="image" accept="image/*" >
    <input type="hidden" name="old-image" value="{{$book->image}}">

  <input type="file" class="ig" id="BookFile" name="book" accept="image/*" >
  
  <input type="hidden" name="old-book" value="{{$book->link}}">




  </form>

  <script type="module">
    let cb =document.querySelector(".cb");
 if (cb.value=="true") {

    document.querySelector("#price").style.display='none';
     }

document.querySelector("#upload").addEventListener('click',function(e) {
        if (document.querySelector("#location").value === ' ') {
          e.preventDefault();
          document.querySelector("#mina").style.display="block"
        }
      })



cb.addEventListener('click',function () {
     if (cb.value=="true") {
       
   
    document.querySelector(".cb").value="false"

           // add price input
    document.querySelector("#price").style.display='block';
     }else{
   
   document.querySelector(".cb").value="true"
   
   // remove price input
   document.querySelector("#price").style.display='none';
     }
  
})

// handling radios

let rad=document.querySelector("#sc")
rad.addEventListener('click',()=>{
  document.querySelector("#bolk").className='on'
  document.querySelector("#locInput").className='off'
  document.querySelector(".bn").style.display="block"
})


let ra=document.querySelector("#hc")
ra.addEventListener('click',()=>{
  document.querySelector("#bolk").className='off'
  document.querySelector(".bn").style.display="none"
  document.querySelector("#locInput").className='on';
 
})

// handling fakebtn image first .only one video is allowed


import  {imagePreviewer}  from  "{{ asset(mix('resources/js/function.js'))}}";

     
let faker=document.querySelector(".aimg");
   let input=document.querySelector("#BookImage")
   let previewer=document.querySelector("#iew")
   imagePreviewer(faker,previewer,input);




// handling the upload book
document.querySelector(".abook").addEventListener('click',()=>{
document.querySelector("#BookFile").click()

let upBook= document.querySelector("#BookFile")
upBook.addEventListener("change",()=>{
document.querySelector(".bn").innerHTML =upBook.files[0].name
})
})













  </script>
</body>
</html>