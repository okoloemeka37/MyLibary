@vite( ['resources/css/app.css','resources/sass/app.scss'])
<body>
  <div class="opt">
    <div class="topNavBar">
    <li class="one"><a href="{{route('home')}}">Logo <span class="fName">Book</span> <span class="sName">Lib</span> </a></li>
    <li class="nS"><input type="text" name="search"  class="navSearch" placeholder="Search Our Library For Books"></li>
    <li class="to"><a href="{{route('feature')}}">Features</a></li>
    
    @auth
    
    <li class="sb bg-lb"><a href="@if (auth()->user()->role =='Admin')
        {{route('dashboard')}}
    @elseif (auth()->user()->role =='Author')
    {{route('AuthorDashboard')}}
    @else  {{route('NormDashboard')}}
    @endif">Add Book</a></li>
    @endauth
    @guest
    <li class="sb bg-lb"><a href="{{route('login')}}">Sign In</a></li>  
    @endguest
    </div>
    
    <div class="secondNav">
        <li><a href="{{route('home')}}">Home</a></li>
        <li class="cate"><a href="">Categories</a>
        
<div id="category">

    <a class="mg" href="{{route('genre','Poetry')}}">Poetry</a>
   <a class="mg" href="{{route('genre','Nonfiction')}}">Nonfiction</a>
   <a class="mg" href="{{route('genre','Drama')}}">Drama</a>
    <a class="mg" href="{{route('genre','Romance')}}">Romance</a>
    <a class="mg" href="{{route('genre','Mystery')}}">Mystery</a>
    <a class="mg" href="{{route('genre','Thriller')}}">Thriller</a>
    <a class="mg" href="{{route('genre','Fiction')}}">Fiction</a>
    <a class="mg" href="{{route('genre','Fantacies')}}">Fantacies</a>
    <a class="mg" href="{{route('genre','Horror')}}">Horror</a>
    <a class="mg" href="{{route('genre','History')}}">History</a> 

</div>
        </li>
        <li><a href="{{route('feature')}}">About</a></li>
        <li><a href="{{route('AllArticle')}}">Blog</a></li>
        <li><a href="">Contact</a></li>
    </div>
    
  </div>


    <script>

        
// search bar function
search()
function search() {
  let searchBar=document.querySelector('.navSearch');
  searchBar.addEventListener('input',()=>{
    document.querySelector("#search-results").innerHTML=''
    let result=document.querySelector("#search-results");
    result.style.display="block";
    let cs=document.querySelector(".cs");
    let csrf=cs.querySelector("input");
    
    let val=searchBar.value;
    if (val.length=== 0) {
      document.querySelector("#search-results").innerHTML=''
    }else{
    fetch(`/live`,{
        method:"POST",
         headers:{ 
          'Content-Type':"application/json",
          'X-CSRF-TOKEN':csrf.value,
        },
        body:JSON.stringify({value:val})
      }).then(resp=>resp.json())
      .then((dat)=>{
        document.querySelector("#search-results").innerHTML=''
        
        dat.books.forEach(data => {
          
        let dte= "http://127.0.0.1:8000/book"+data['id'];
          let htm=` <a href=${dte}>
          <div class="result-item">
              <p class="tit">${data['title']}</p>
              <p class="aut">by ${data['author']}</p>
          </div>
      </a>
          `
          document.querySelector("#search-results").innerHTML +=htm
                }); 
      })
    }
  })
}
    </script>