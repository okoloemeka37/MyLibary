@extends('layouts.head')

@section('Register')
@endsection
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
@extends('all.sideNav')

<div class="registration-container reg">
    <h2>FIll The Form To Be An Author</h2>

    <form method="POST" enctype="multipart/form-data" action="{{route('BeAuthHandle',auth()->user()->id)}}">
        @csrf
        @method('PUT')

        <label for="author_description">Author Description:</label>
        <textarea name="author_description" id="" cols="47" rows="3"@error('author_description') style=" border: 1px solid #ff0000;" @enderror >{{old('author_description')}}</textarea>
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



        

        <button type="submit" class="signup" id="f">Continue</button>
   
    </form>
    </div>
</body>

<script>
    let phone=document.querySelector("#p")
phone.addEventListener('input',()=>{
if (phone.value.length > 11) {
    phone.value=phone.value.slice(0,11)
}
})
</script>