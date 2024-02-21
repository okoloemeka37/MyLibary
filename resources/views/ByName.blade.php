@extends('../layouts.head')
@extends('../layouts.Nav')

@section('title') BookLib @endsection

<style>
    /* public/css/styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.author-profile {
    max-width: 800px;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
    margin-top: 20px;
    margin-bottom: 20px;
}

p {
    color: #4e4e4e;
    margin-top: 10px;
}
.e{
    color: #1286e4;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 5px;
}

.section {
    margin-top: 20px;
    text-align: center;
}

.author-profile{
    text-align: center;

}
.report{
    border: 1px solid rgb(189, 189, 189);
    background-color: rgb(230, 230, 230);
    width: fit-content;
   margin-left: 77%;
   padding: 3px;

}
.alert{
    background-color: #1286e4;
width: fit-content;
padding: 5px;
margin-top: 10%;
}

</style>

@section('content')

{{--search bar result--}}
<p class="cs">@csrf</p>

<div id="search-results">

</div>



    <div class="author-profile">

        @if ($user[0]['id']== auth()->user()['id'])

            @else
            @if (session('message'))
            <p class="alert blue"> {{session('message')}}</p>
            @else
            <p class="report"><a href="{{route('report_index',['User',$user[0]['id']])}}">Report This Account</a> </p>

            @endif
           
        @endif
   

        <h1>{{$user[0]->name}}</h1>
        <p class="e">Email: {{$user[0]->email }}</p>
        <p>Description: {{$user[0]['author_description'] }}</p>

        <div >
            <h2>Books by {{$user[0]->name }}</h2>
            <div class="book-flex">
    
                @if(count($books)===0)
                <h4>No Books Available</h4>
                @else
                @foreach ($books as $book )
             
                <?php $image="BookImages/".$book['image'] ?>
               
                <div class="book-entry bookies">
        <a href="{{route('sin',$book['id'])}}">
                  <img class="book-image" src="{{ URL::asset($image) }}" alt="Book Image 1">
                  <div class="book-info">
                    <h3 class="title">{{$book['title']}}</h3>
                     <p>{{$book['genre']}}</p>
                    <p class="author">{{$book['author']}} (<span>Uploaded by <a href="{{route('sortAuth',$book->user_id)}}" style="color: red;"> {{$book->user['name']}}</a></span>)</p>
                  
                </div>
        
                    <p class="price">Price:@if($book['price']=='') <span style=" color:skyblue"> Free Download </span>@else {{$book['price']}} @endif</p>
            </a>
                </div>
           
                @endforeach
                @endif
        </div>

        <div class="section">
            <h2>Blogs by {{$user[0]->name }}</h2>
            <ul>
                @if (true)
                   
                @else
                @foreach ($books as $book)
                <li>{{ $book->title }}</li>
            @endforeach
                @endif
               
            </ul>
        </div>
    </div>
@endsection
