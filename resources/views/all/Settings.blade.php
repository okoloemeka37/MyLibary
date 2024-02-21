@extends('all.sideNav')
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Settings</title>
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
 

  @section('content')





     <p class="cu" name="Settings"></p>

  <header>
    <h1>User Settings</h1>
  </header>

 <section>

       <button class="btn"><a href="{{route("profile_edit")}}"> Edit Profile</a></button>

       <button class="btn"><a href="{{route("confirm_email")}}">Change Password</a></button>
      
      </section>
</body>
 


@endsection