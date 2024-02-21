<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    p {
      color: #666;
    }

    .confirmation-info {
      margin-bottom: 20px;
    }

    .confirmation-code {
      margin-bottom: 20px;
    }

    .input-group {
      display: flex;
      margin-bottom: 20px;
      margin-left: 15%;
    }

    input {
      flex: 1;
      padding: 10px;
      font-size: 16px;
      text-align: center;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .footer {
      background-color: #f4f4f4;
      padding: 10px;
      border-top: 1px solid #ddd;
      text-align: center;
    }
    span{
      color: rgb(5, 193, 255);
    }
    .text-error{
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Email Confirmation</h1>

    <div class="confirmation-info">
      <p>A 5 digit confirmation code has been sent to your email <span>{{auth()->user()->email}} </span> Please check your inbox and enter the code below to confirm your email.</p>
    </div>

    <div class="confirmation-code">
      <div class="input-group">

        <form action="{{route('codeCheck')}}" method="post">
 @csrf
        <input type="text" name="token" class="tkn" placeholder="Enter Token">

        


    


        <button type="submit">Confirm</button>
        @error('token') <p class="text-error">{{$message}}</p>@enderror
        @if (session('message'))
        <p class="text-error">{{session('message')}}</p>
    @endif
      </form>
      </div>
    </div>

    <div class="footer">
      <p>&copy;  {{date('Y')}} <a class="non" href="{{route('home')}}">BookLib</a>. All rights reserved.</p>
    </div>
  </div>

  <script>
    let tkn=document.querySelector(".tkn");
    tkn.addEventListener('input',()=>{
     
      tkn.value=tkn.value.slice(0,5)
    })
  
    let tr=4
    console.log(typeof(tr))
  </script>
</body>
</html>
