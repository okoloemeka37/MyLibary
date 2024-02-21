@extends('layouts.head')

@section('Login')
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
  
  
<body>
	  @vite( ['resources/sass/app.scss'])


    <div class="registration-container reg" >
        <h2>Change Password</h2>
        <form method="POST" action="{{route('p_change_handle')}}">
            @csrf
         
            @if (session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif

        <label for="">New Password</label>
        <input type="password" id="password" name="password" ; @error('email') style=" border: 1px solid #ff0000;" @enderror value="{{old('twitter_link')}}">
        @error('email')<p class="text-danger">{{$message}} </p>@enderror



        <label for="password">Confirm Password:</label>
        <input type="password" name="password_confirmation" @error('password') style=" border: 1px solid #ff0000;" @enderror >
        @error('password')<p class="text-danger">{{$message}} </p>@enderror
          
        <button type="submit" class="login" id="f">Login</button>
				
        </form>
         
    </div>
   
    
</body>
</html>
