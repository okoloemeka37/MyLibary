<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
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

    .reset-info {
      margin-bottom: 20px;
    }

    .reset-button {
      margin-bottom: 20px;
      text-align: center;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      text-decoration: none;
      color: #ffffff;
      background-color: #4caf50;
      border-radius: 5px;
    }

    .footer {
      background-color: #f4f4f4;
      padding: 10px;
      border-top: 1px solid #ddd;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Password Reset</h1>

    <div class="reset-info">
      <p>We received a request to reset your password. If you did not make this request, you can ignore this email.</p>
    </div>

    <div class="reset-button">
        <h2>Your Token</h2>
      {{$data["token"]}}
    </div>

    <div class="footer">
      <p>&copy; {{date('Y')}} <a class="non" href="{{route('home')}}">BookLib</a>. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
