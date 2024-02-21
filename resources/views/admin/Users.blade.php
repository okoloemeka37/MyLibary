<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link rel="stylesheet" href="stle.css">
</head>
<body>
  @vite( ['resources/sass/Admin.scss'])

 
  @extends('all.sideNav')

  @section('con')
 
  @endsection


  <p class="cu" name="Users"></p>


  <section>
    <div class="search-bar">
      <input type="text" id="su" placeholder="Search...">
      </div>
    
    <?php $id=1 ?>
    <div class="user-section">
      <div class="split">
      <h2>User List</h2>

</div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Blogs</th>
            <th>Books</th>
            <th>country</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
       @if ($users=='')
         
       @else
       @foreach ($users as $user)
      
       
       <tr class="us">
         <td>{{$id++}}</td>
         <td class="name"><a href="{{route('sortAuth',$user->id)}}" style="color: red;">{{$user['name']}}</a></td>
         <td class="email">{{$user['email']}}</td>
        <td><a href="#">{{$user['posts_count']}}</a></td>
       <td><a href=""> {{$user['books_count']}} </a></td>
       <td><a href=""> {{$user['country']}} </a></td>
         <td class="user-actions">
           <button class="ws">Email</button>
           <button class="red" ct={{$user["id"]}}>Delete</button>
           
         </td>
       </tr>
      
       
       @endforeach
        
       @endif
        
        </tbody>
      </table>


      
      <form action="">
        @csrf
      </form>

  
    </div>
  </section>

  <script>
       
       let btn= document.querySelectorAll(".red")
       btn.forEach(el=> {
        el.addEventListener("click",function() {

let gf=confirm("Are You Sure You Want to Delete User");
let input=document.querySelectorAll("input")[1]
if (gf) {
let val=el.getAttribute("ct")

fetch(`/delete_user/${val}`,{
  method:"DELETE",
  headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN':input.value,
      },
}).then(response=>{
  if (!response.ok) {
    throw new Error('Network response was not ok');
    
  }
  return response.json();
}).then(data=>{
el.parentElement.parentElement.remove()
})
}
  })
       });
   
       //searching users
       let input=document.querySelector("#su");
  input.addEventListener('keyup',()=>{
    let val=input.value;

    if (val.length=== 0) {
      let us=document.querySelectorAll(".us");
    
    for (let i = 0; i <us.length; i++) {
      const user = us[i];
      user.style.display="table-row"
    }

   
    }else{
      let us=document.querySelectorAll(".us");
     
    us.forEach(user => {
      let name=user.querySelector(".name").innerHTML
      let email=user.querySelector(".email").innerHTML

     if ((name.toUpperCase().indexOf(val.toUpperCase()) != -1) ||(email.toUpperCase().indexOf(val.toUpperCase()) != -1)  ) {
          
          user.style.display="table-row"
        }else{
          user.style.display="none"
          
        } 
    });
  }

  })
   
  
  </script>
 
</body>
</html>
