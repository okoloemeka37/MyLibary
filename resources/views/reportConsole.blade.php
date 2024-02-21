<!-- resources/views/reports/show.blade.php -->



<style>
    /* public/css/styles.css */

/* public/css/styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.report-form {
    max-width: 400px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
}

select,
input,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #4caf50;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

.alert {
    margin-top: 20px;
    padding: 15px;
    background-color: #f44336;
    color: #ffffff;
    border-radius: 4px;
}


</style>
@extends('../layouts.head')
@extends('../layouts.Nav')

@section('Report') BookLib @endsection

@vite( ['resources/js/app.js'])

@section('content')
    <div class="report-form">
        <h1>Report {{$type['type']}}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{route("report_store")}}" method="POST">
            @csrf

            <label for="reported_type">Report Type:</label>
            <select name="type" id="reported_type"  required>
                <option value="book" @if ($type['type']=='Book') selected @endif >Book</option>
                <option value="user" @if ($type['type']=='User') selected @endif>User</option>
            </select>

            @error('type') <p class="text-danger">{{$message}}</p>@enderror

            <label for="reported_id">Name of Reported Item:</label>
            <input type="text" name="item" id="reported_id" required value="{{$type['name']}}">

            @error('item') <p class="text-danger">{{$message}}</p>@enderror

            <input type="hidden" name="item_id" value={{$type['id']}}>

            <label for="reason">Reason for Report:</label>

            <textarea name="reason" id="reason" rows="4" required></textarea>

            @error('reason') <p class="text-danger">{{$message}}</p>@enderror

            <button type="submit">Submit Report To Admin</button>
        </form>
    </div>
@endsection
