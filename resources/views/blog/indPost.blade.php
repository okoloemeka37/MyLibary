@extends('../layouts.head')
@extends('../layouts.Nav')

@section('title') {{$articles['title']}} @endsection

@vite( ['resources/sass/app.scss','resources/js/comment&ratings.js'])
<form action="" method="post" >
    @csrf
</form>
<style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f5fe; /* Light Blue Background */
}

.d-flex{
    display: flex;
    margin-bottom: 30px;
}
.article {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.featured-image {
    width: 100%;
    max-height: 300px; /* Adjust the max height to your preference */
    object-fit: cover;
    border-radius: 8px 8px 0 0;
}

.article-details {
    padding: 20px;
}

h1 {
    color: #333;
    margin-bottom: 10px;
}

.author, .date {
    color: #2a81f1;
    margin-top: 5px;
    margin-right: 30px;
}

.tent {
    color: #666;
    line-height: 1.6;
}

.share-button {
    margin-top: 20px;
}

button {
    background-color: #3498db; /* Blue Button Color */
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2980b9; /* Darker Blue on Hover */
}

/* Style the content as needed, e.g., add more spacing, adjust fonts, etc. */

</style>



@section('content')
<p class="table" name="posts"></p>


<?php $image="postImages/".$articles['image'] ?>
<div class="article">
    <img class="featured-image" src="{{ URL::asset($image) }}" alt="Featured Image">
    <div class="article-details">
        <h1><span class="gb"> {{ $articles->title }}</span></h1>
        <div class="d-flex">
        <p class="author">By {{ $articles->user->name }}</p>
        <p class="date">Published on {{ $articles->created_at->format('F j, Y') }}</p>
    </div>
        <div class="tent">
            {!! $articles->content !!}
        </div>
        <div class="share-button">
            <button>Share</button>
        </div>


        <div class="comment-form">
            <textarea placeholder="Write your comment..." name="content" class="content"></textarea>
            <input type="hidden" class="parent_id" value="0">
            <p class="com_err text-error"></p>      
            <input type="hidden" class="ed_id" value=''>
           <input type="hidden" name="" value="{{$articles['user']['id']}}" class="owner">

           @guest
           <button type="submit"><a href="{{route('login')}}">Sign In</a></button>
           @else
           <button type="submit" class="Add_comment">Add Comment</button>
           <button type="submit" class="edit_comment" style="display: none;">Edit Comment</button>
           @endguest
           
           
            <input type="hidden" name="book_id" class="item_id" value="{{$articles['id']}}">
        </div>
        <div class="comments"></div>
    </div>
</div>



@endsection
