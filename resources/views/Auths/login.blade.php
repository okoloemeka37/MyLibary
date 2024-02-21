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
        <h2>Login TO Continue</h2>
        <form method="POST" action="{{route('login_handle')}}">
            @csrf
          
            @if (session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif

        <label for="email">Email</label>
        <input type="email" id="email" name="email" ; @error('email') style=" border: 1px solid #ff0000;" @enderror value="{{old('twitter_link')}}">
        @error('email')<p class="text-danger">{{$message}} </p>@enderror



        <label for="password">Password:</label>
        <input type="password" name="password" @error('password') style=" border: 1px solid #ff0000;" @enderror >
        @error('password')<p class="text-danger">{{$message}} </p>@enderror
          
        <button type="submit" class="login" id="f">Login</button>
				
        </form>
         <div class="login-link">
      Don't have an account? <a href="{{route('register')}}">signup here</a>
    </div>
    </div>
   
    
</body>
</html>
