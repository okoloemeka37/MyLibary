<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Book Management</title>


</head>
<body>
  @vite( ['resources/sass/Admin.scss','resources/js/Admin.js'])
  
  <header>
    <h1>Admin Book Management</h1>
  </header>
  
  @extends('all.sideNav')


 
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
  


    <div class="book-grid">
      
      @foreach ($adminBook as $book )
      <?php $image="BookImages/".$book['image'] ?>
      <a href="{{route('sin',$book['id'])}}">
      <div class="book-entry bookies">
        <img class="book-image" src="{{ URL::asset($image) }}" alt="Book Image 1">
        <div class="book-info">
          <h3 class="title">{{$book['title']}}</h3>
          <p class="author">{{$book['author']}} (<span>Uploaded by <a href="" style="color: red;">{{$book->user['name']}}</a></span>)</p>
        </div>
         <div class="book-buttons">
          <button class="edit"><a href="{{route('edit_btn',$book->id)}}">Edit</a></button>
          <button class="delete" ct={{$book->id}} >Delete</button>
        </div>
      </div>
      </a>
      @endforeach
    
      <form action="">
        @csrf
      </form>

 
    </div>
    <button class="view-more-button" id="v-more">View More Books</button>
    <button class="view-more-button" id="v-less" style="display: none;">View Less Books</button>

{{-- the books uploaded by other users --}}

<div class="set">
      <h1 class="ub">User Book</h1>

    <div class="df">

    <p class="tf now">All</p>
          <p class="tf"> Poetry</p>
         <p class="tf">Nonfiction</p>
         <p class="tf">Drama</p>
          <p class="tf">Romance</p>
            <p class="tf">Mystery</p>
              <p class="tf">Thriller</p>
                <p class="tf">Fiction</p>
                  <p class="tf">Fantacies</p>
                    <p class="tf">Horror</p>
                      <p class="tf">History</p> 

    </div>
  </div>

  {{-- user books --}}


  <div class="book-grid">

    @foreach ($norms as $book )
    <?php $image="BookImages/".$book['image'] ?>
   
    <div class="book-entry-norms bookies">
      <a href="@if ($book['deleted_at'] != NULL)
      {{route('s_deleted',$book['id'])}}
        @else
        {{route('sin',$book['id'])}}
      @endif">
      @if ($book['deleted_at'] != NULL)
      <div class="blur"><p>You Deleted This Book</p></div>        
      @endif 

      <img class="book-image" src="{{ URL::asset($image) }}" alt="Book Image 1">
      <div class="book-info">
        <h3 class="title">{{$book['title']}} (<i class="genre">{{$book['genre']}}</i>)</h3>
        <p class="author">{{$book['author']}}(<span>Uploaded by <a href="{{route('sortAuth',$book->user_id)}}" style="color: red;">{{$book->user['name']}}</a></span>)<p>
    
    
      </div>
      
       
       
        <div class="nice-buttons" style=" @if ($book['deleted_at'] != NULL) display:block; @else display:none; @endif ">
        <button class="restore-norms restore" ct={{$book->id}}>Restore</button>
        <button class="delete" ct={{$book->id}} id="user" >Delete</button>

      </div>
   
      <div class="book-buttons" style=" @if ($book['deleted_at'] != NULL) display:none; @else display:flex; @endif "> 
      <button   class="delete-norms" ct={{$book->id}} user_id={{$book['user_id']}} >soft Delete</button>
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
 
    //veiwing more books
    let v_more=document.querySelector("#v-more");
    v_more.addEventListener("click",function () {
      let books=document.querySelectorAll(".book-entry");
      for (let i = 0; i < books.length; i++) {
      const book = books[i];
      book.style.display="block"
    }
    v_more.style.display="none";
    document.querySelector("#v-less").style.display='block';
    })
    
    //viewing less books
    let v_less=document.querySelector("#v-less");
    v_less.addEventListener("click",function () {
      let books=document.querySelectorAll(".book-entry");
      for (let i = 12; i < books.length; i++) {
      const book = books[i];
      book.style.display="none"
    }
    v_less.style.display="none"
    document.querySelector("#v-more").style.display="block"
    })

    


//search



search()


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
