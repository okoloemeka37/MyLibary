@extends('../layouts.head')
@extends('../layouts.Nav')

@section('title') BookLib @endsection


@section('content')

{{--search bar result--}}
<p class="cs">@csrf</p>

<div id="search-results">

</div>


<style>
   .book-flex{
        padding:30px; 
    }
</style>

<div class="book-flex">
 
    @foreach ($books as $book )
    <?php $image="BookImages/".$book['image'] ?>
   
    <div class="book-entry bookies">
<a href="{{route('sin',$book['id'])}}">
      <img class="book-image" src="{{ URL::asset($image) }}" alt="Book Image 1">
      <div class="book-info">
        <h3 class="title">{{$book['title']}}</h3>
         <p>{{$book['genre']}}</p>
        <p class="author">{{$book['author']}} (<span>Uploaded by <a href="" style="color: red;"> {{$book->user['name']}}</a></span>)</p>
      
    </div>

        <h2 class="price">Price:@if($book['price']=='') Free Download @else {{$book['price']}} @endif</h2>
</a>
    </div>

    @endforeach
   


  </div>
  <div class="pagination">
    <span class="page-links">
        {!! $books->links('vendor.pagination.default') !!}
    </span>
</div>

@endsection