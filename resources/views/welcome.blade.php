<?php
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip= $_SERVER['HTTP_CLIENT_IP']; 
        }
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip= $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if (!empty($_SERVER['HTTP_X_REAL_IP'])){
            $ip= $_SERVER['HTTP_X_REAL_IP'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        $ip='102.88.82.153';
      
        $ip_data=@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));


$currency=$ip_data->geoplugin_currencyCode;

?>
<script defer>

function change(price,dom) {
    
    let id="93be5a7561d547409152e8cc5ff50773";
let country=document.querySelector(".cur").getAttribute('type');


    const options = {method: 'GET', headers: {accept: 'application/json'}};
fetch(`https://openexchangerates.org/api/latest.json?app_id=${id}`, options)
  .then(response => response.json())
  .then(response =>{
    
    let rate=response['rates'][country];
   
    let change=Math.ceil(Number(price)*rate);
    let id="#"+"book"+Number(dom).toString();
  
    document.querySelector(id).innerHTML=country+" "+change;
    
    

  })
  .catch(err => console.error(err));
}
</script>

@extends('../layouts.head')

@section('title') BookLib @endsection

@vite( ['resources/js/app.js'])

    </head>
@extends('../layouts.Nav')


@section('content')


{{--search bar result--}}


<p class="cs">  @csrf</p>

<div id="search-results">

</div>



<p class="cur" type={{$currency}}></p>


<div class="hold">
<div class="flat fade" style="background-image:url({{ URL::asset('images/front.jpg') }})">
    
    <div class="writes td">
        <p class="tg ">Science Fiction</p>
        <h1 class="ht">The History <br> Of Niguaragua</h1>
        <li class="sb bg-red f"><a href="">Browse More</a></li>
    </div>

</div>

<div class="flat fade " style="background-image:url({{ URL::asset('images/f.jpg') }})">
    
    <div class="writes td">
        <p class="tg ">Science Fiction</p>
        <h1 class="ht">The History <br> Of Niguaragua</h1>
        <li class="sb bg-red f"><a href="">Browse More</a></li>
    </div>

</div>
<div class="flat fade" style="background-image:url({{ URL::asset('images/f2.jpg') }})">
    
    <div class="writes td">
        <p class="tg ">Science Fiction</p>
        <h1 class="ht">The History <br> Of Niguaragua</h1>
        <li class="sb bg-red f"><a href="">Browse More</a></li>
    </div>

</div>
</div>


<div class="mor">
    <h2 class="hd">Recent Blog Post</h2>
    <i class="fa-solid fa-angle-left"  id="minus"></i>
     
    <i class="fa-solid fa-angle-right"id="plus"></i>
      
    <div class="gr ">
</div>

@foreach($posts as $post)
<?php $image="postImages/".$post['image'] ?>
<div class="tm">
<a href="{{route('indPost',$post['id'])}}">
                <img src="{{ URL::asset($image) }}" alt="">
                <div class="net">
                        <h1 class="title">{{$post['title']}}</h1>
                        <p class="author">{{$post['author']}}</p>
                        <div class="etc" style="display:flex; justify-content:space-between;"><p>{{$post['num_comments']}}<i class="fa-solid fa-comments"></i></p>
                          <p>{{$post['views']}}<i class="fa-solid fa-eye"></i></p>
                          </div>
                        
                </div>
      
            </a>
</div>

@endforeach


</div>

<div class="tw">
    <div class="fv">
        <h1 class="ft">Featured This Week </h1>

        <div class="ftw">
           
            <div class="sf">
                <img src="{{ URL::asset('images/im.jpg') }}" alt="">
                <div class="nt">
                    <h1 class="title">The Barrons Betrayal</h1>
                    <p class="author"> by E.O Zyler</p>
                    <p class="pt">$g50</p>
                    <p class="revies">(<span>120</span> reviews)</p>  
                  <p ><a href=""class="sd">View Details</a>  </p>    
                </div>

            </div>

            <div class="sf">
                <img src="{{ URL::asset('images/im.jpg') }}" alt="">
                <div class="nt">
                    <h1 class="title">The Betrayal</h1>
                    <p class="author"> by E.O Zyler</p>
                    <p class="pt">$g50</p>
                    <p class="revies">(<span>120</span> reviews)</p>  
                  <p ><a href=""class="sd">View Details</a>  </p>    
                </div>

            </div>

            <div class="sf">
                <img src="{{ URL::asset('images/im.jpg') }}" alt="">
                <div class="nt">
                    <h1 class="title">The Barrons Wars</h1>
                    <p class="author"> by E.O Zyler</p>
                    <p class="pt">$g50</p>
                    <p class="revies">(<span>120</span> reviews)</p>  
                  <p ><a href=""class="sd">View Details</a>  </p>    
                </div>

            </div>
       
        </div>

    
    </div>

    <div class="di">
        <div >
    <img class="fl" src="{{ URL::asset('images/penny.jpg') }}" alt="">
            <div class="up">
                <p class="ts ">Science Fiction</p>
                <small class="h">The History <br> Of Penny Wise</small>
               
            </div>
        
        </div>
    </div>
</div>


<div class="lpi">
    <div class="df">

        <p class="tf now"><a class="ta" href="{{route('gen','null')}}">All</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Poetry')}}">Poetry</a></p>
       <p class="tf"><a class="ta" href="{{route('gen','Nonfiction')}}">Nonfiction</a></p>
       <p class="tf"><a class="ta" href="{{route('gen','Drama')}}">Drama</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Romance')}}">Romance</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Mystery')}}">Mystery</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Thriller')}}">Thriller</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Fiction')}}">Fiction</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Fantacies')}}">Fantacies</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','Horror')}}">Horror</a></p>
        <p class="tf"><a class="ta" href="{{route('gen','History')}}">History</a></p> 
 
    </div>

    <div class="book-flex">
 
        @foreach ($books as $book )
        <?php $image="BookImages/".$book['image'] ?>
       
        <div class="book-entry bookies">
<a href="{{route('sin',$book['id'])}}">
          <img class="book-image" src="{{ URL::asset($image) }}" alt="Book Image 1">
          <div class="book-info">
            <h3 class="title">{{$book['title']}}</h3>
             <p>{{$book['genre']}}</p>
            <p class="author">{{$book['author']}} (<span>Uploaded by <a href="{{route('sortAuth',$book->user_id)}}" style="color: red;" > {{$book->user['name']}}</a></span>)</p>
          
        </div>

            <p class="price">Price:<span style=" color:skyblue" id=book{{ $book->id }} > @if($book['price']=='')  Free Download @else  <script>change({{$book['price']}},{{$book['id']}})</script> </span> @endif</p>
    </a>
        </div>
   
        @endforeach
       
  
   
      </div>
      <div class="pagination">
        <span class="page-links">
            {!! $books->links('vendor.pagination.default') !!}
        </span>
    </div>
</div>


<div class="jn" style="background-image:url({{ URL::asset('images/grid.jpg') }})">

        <h2 class="mv">Message Website creator</h2>
      
            <form action="">
            <input type="text" placeholder="Enter Your Name">
                <input type="email" placeholder="Enter Your Email">
                <textarea name="content" id="" cols="30" rows="10" placeholder="Enter Your Message"></textarea>
                <button>Subscribe</button>
            </form>
        </p>


</div>

<script defer>
    let current="{{$type}}"
   let ta=document.querySelectorAll(".ta")
   
   ta.forEach(el => {
    el.parentElement.classList.remove('now')
    if (el.innerHTML===current) {
        el.parentElement.classList.add('now')
    }
   });
   
</script>
@endsection


</body>
</html>