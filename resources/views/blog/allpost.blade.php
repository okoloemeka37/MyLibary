@extends('../layouts.head')
@extends('../layouts.Nav')

@section('title') All Articles @endsection

@vite( ['resources/js/app.js'])

@section('content')

<section class="lpi">
    <div class="book-flex">

            @foreach ($posts as $post )
            <?php $image="postImages/".$post['image'] ?>

                <div class="book-entry bookies">
                  <a href="{{route('indPost',$post['id'])}}">
                    <img class="book-image" src="{{ URL::asset($image) }}" alt="post">
                    <div class="book-info">
                      <h3 class="title">{{$post['title']}}</h3>
                      <p>{{$post['slug']}} <span style="color: red;">Read More...</span></p>
                      <p class="author" style="color: black;">BY <a href="{{route('sortAuth',$post->user_id)}}" style="color: red;"> {{$post->user['name']}}</a></p>
                    </div>
                  </a>
                </div>

            @endforeach
    </div>
</section>
@endsection