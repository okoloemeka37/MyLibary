@extends('layouts.head')
  <title>Author Post Management</title>


</head>
<body>
 
  <header>
    <h1>Author Post Management</h1>
  </header>
  
  @extends('all.sideNav')
  @vite( ['resources/sass/Admin.scss','resources/js/Admin.js']) 
  <p class="cu" name="Posts"></p>
 

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
  
              @foreach ($posts as $post )
              <?php $image="postImages/".$post['image'] ?>
  
                  <div class="book-entry bookies">
                    <a href="{{route('indPost',$post['id'])}}">
                      <img class="book-image" src="{{ URL::asset($image) }}" alt="post">
                      <div class="book-info">
                        <h3 class="title">{{$post['title']}}</h3>
                        <p>{{$post['slug']}} <span style="color: red;">Read More...</span></p>
                        <p class="author" style="color: black;">BY <a href="{{route('sortAuth',$post->user_id)}}" style="color: red;"> {{$post->user['name']}}</a></p>
                        <div class="etc"><p>{{$post['num_comments']}}<i class="fa-solid fa-comments"></i></p>
                          <p>{{$post['views']}}<i class="fa-solid fa-eye"></i></p>
                          </div>
                          <div class="book-buttons">
        <button class="edit"><a href="{{route('edit_post',$post->id)}}">Edit</a></button>
        <button class="delete" ct={{$post->id}} >Delete</button>
      </div>
                      </div>
                     
                    </a>
                  </div>
               
              @endforeach
      </div>
 
   
    
      <form action="">
        @csrf
      </form>
      <script>
 let csrf=document.querySelectorAll("input")[1]


        let dels=document.querySelectorAll(".delete");
        dels.forEach(del => {
          
          del.addEventListener('click',()=>{

        let data={id:del.getAttribute("ct")};
        
       fetch(`/author-delete-book`,{
           method:"POST",
           headers: {
                   'Content-Type': 'application/json',
                   'X-CSRF-TOKEN':csrf.value,
               },
               body:JSON.stringify(data)
       
         }) 
         .then(res=>res.json())
         .then((data)=>{
          del.parentElement.parentElement.parentElement.parentElement.remove()
           document.querySelector(".alert2").style.display="block"
           document.querySelector(".alert2").innerHTML=data.message;
          
           setTimeout(() => {
         document.querySelector(".alert2").style.display='none'
       }, 2100);
         })

        });

      })
      </script>


      
      </body>
</html>