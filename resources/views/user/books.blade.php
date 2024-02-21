@extends('layouts.head')

  <title>Admin Book Management</title>
</head>
<body>
 
  <header>
    <h1>Admin Book Management</h1>
  </header>
  
  @extends('all.sideNav')
  @vite( ['resources/sass/Admin.scss','resources/js/Admin.js']) 
  <p class="cu" name="Books"></p>
 

  <section>
    @if (session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
    @endif

    <div class="alert2 alert-success" style="display:none;">
     
    </div>


    <div class="search-bar">
    <input type="text" placeholder="Search Your Library" id="sl">
    </div>
  
   

   
    
      <form action="">
        @csrf
      </form>

 

{{-- the books uploaded by other users --}}



  {{-- user books --}}

  
  <div class="book-grid">
 
    @foreach ($books as $book )
    <?php $image="BookImages/".$book['image'] ?>
    <div class="book-entry-norms bookies">
      <a href="@if ($book['deleted_at'] != NULL)
      {{route('s_deleted',$book['id'])}}
        @else
        {{route('sin',$book['id'])}}
      @endif">
      @if ($book['deleted_at'] != NULL)
      <div class="blur"><p>Admin Deleted This Book</p></div>        
      @endif 

      <img class="book-image" src="{{ URL::asset($image) }}" alt="Book Image 1">
      <div class="book-info">
        <h3 class="title">{{$book['title']}} (<i class="genre">{{$book['genre']}}</i>)</h3>
        <p class="author">{{$book['author']}} (<span>Uploaded by <a href="" style="color: red;">{{$book->user['name']}}</a></span>)</p>
    
        <div class="etc"><p>{{$book['num_comments']}}<i class="fa-solid fa-comments"></i></p>
          <p>{{$book['views']}}<i class="fa-solid fa-eye"></i></p>
          </div>
      </div>
      
       
      <div class="book-buttons">
        <button class="edit"><a href="{{route('edit_btn',$book->id)}}">Edit</a></button>
        <button class="delete" ct={{$book->id}} >Delete</button>
      </div>
        
      </a>
    </div>

    @endforeach
    

  </div>

  <button class="view-more-button" id="u-more">View More Books</button>
  <button class="view-more-button" id="u-less" style="display: none;">View Less Books</button>


  </section>


  
<div id="overlay"></div>

<div id="popup-container">
    <h2>Reason</h2>
   
    <textarea name="" id="popup-input" cols="30" rows="2"  placeholder="Type something..." ></textarea>
    <p class="text-danger err"></p>
    <button class="proceed">Proceed</button>
    <button class="cancel ">Cancel</button>
</div>



  <script>
 
//search

search()
let csrf=document.querySelectorAll("input")[1]

function search(params) {
  let input=document.querySelector("#sl");
  input.addEventListener('keyup',()=>{
   
    let val=input.value;
    if (val.length=== 0) {
      let books=document.querySelectorAll(".book-entry");
    
    for (let i = 12; i <books.length; i++) {
      const book = books[i];
      book.style.display="none"
    }

    let boos=document.querySelectorAll(".book-entry-norms");
    
    for (let i = 12; i <boos.length; i++) {
      const book = boos[i];
      book.style.display="none"
    }
    }else{
      let docs=document.querySelectorAll(".bookies")
      docs.forEach(ele => {
        
    
   
        let title=ele.querySelector(".title").innerHTML;
        let author=ele.querySelector(".author").innerHTML;
       // console.log(val)
      
        if ((title.toUpperCase().indexOf(val.toUpperCase()) != -1) ||(author.toUpperCase().indexOf(val.toUpperCase()) != -1)  ) {
          
          ele.style.display="block"
        }else{
          ele.style.display="none"
          
        }
      });
  }
})

}





  </script>
</body>
</html>
