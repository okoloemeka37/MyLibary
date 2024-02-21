<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Purchase Confirmation</title>
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
      text-align: center;
    }

    h1 {
      color: #333;
    }

    p {
      color: #666;
    }

    .book-info {
      margin-bottom: 20px;
    }

    .buyer-info {
      margin-bottom: 20px;
    }

    .sales-info {
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
    <h1>Book Purchase Confirmation</h1>

    <div class="book-info">
      <h2>Book Information</h2>
      <p><strong>Title:</strong><a href="{{route('sortAuth',$data['id'])}}">{{$data['title']}}</a></p>
      <p><strong>Author:</strong>{{$data['author']}}</p>
      <p><strong>Price:</strong>{{$data['price']}}</p>
    </div>

    <div class="buyer-info">
      <h2>Buyer Information</h2>
      <p><strong>Name:</strong>{{$data['name']}}</p>
      <p><strong>Email:</strong>{{$data['email']}}</p>
    </div>

    <div class="sales-info">
      <h2>Sales Information</h2>
      <p><strong>Quantity Sold:{{$data['solds']}}</strong></p>
      
    </div>

    <div class="footer">
      <p>&copy; {{date('Y')}} <a class="non" href="{{route('home')}}">BookLib</a>. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
