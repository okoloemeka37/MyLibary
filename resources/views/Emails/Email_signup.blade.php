<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Our Website</title>
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

    .welcome-message {
      margin-bottom: 20px;
    }

    .intro-info {
      margin-bottom: 20px;
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
    <h1>Welcome To BookLib</h1>

    <div class="welcome-message">
      <p>Dear {{$data['name']}},</p>
      <p>Thank you for joining our community! We are excited to welcome you to BookLib.</p>
    </div>

    <div class="intro-info">
      <p>Here are some key points about our website:</p>
      <ul>
        <li>Discover a wide range of Your Favourite Genres.</li>
        <li>Connect with other users who share your interests.</li>
        <li>Stay updated on the latest Books news and trends.</li>
      </ul>
    </div>

    <div class="footer">
      <p>&copy; {{date('Y')}} <a class="non" href="{{route('home')}}">BookLib</a>. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
