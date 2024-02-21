//changing navbars
let nons=document.querySelectorAll(".non");
let current=document.querySelector(".cu").getAttribute("name");
nons.forEach(non => {
  if (non.innerHTML===current) {
    non.classList.add("bg");
  }
});
















if (document.querySelector("#genre")) {

    let genres=[
       "Fiction",
       "Poetry",
       "Nonfiction",
       "Drama",
       "Romance",
       "Mystery",
       "Thriller",
       "Science Fiction",
       "Fantacies",
       "Horror",
       "History",
   
]

    let genre_input=document.querySelector("#genre");
    let holder=document.querySelector(".dropsHolder");

    genre_input.addEventListener("input",()=>{

        document.querySelectorAll(".drops").forEach(drop=>{
          
               let text=drop.innerHTML.toUpperCase();
               let getting=genre_input.value.toUpperCase();

               if (text.indexOf(getting)== -1) {
                drop.style.display='none'
               }else{
                drop.style.display='block'
               }
          
            })
           
    })



    genre_input.addEventListener("blur",()=>{
        

    document.querySelectorAll(".drops").forEach(drop=>{
     drop.addEventListener("click",() =>{
        document.querySelector("#genre").value=drop.innerHTML;
        document.querySelector(".dropsHolder").innerHTML=''
     })
    
    })  
setTimeout(() => {
    document.querySelector(".dropsHolder").innerHTML=''
}, 300);
     
    })




    genre_input.addEventListener("focus",()=>{

        if(document.querySelectorAll(".drops")){
            document.querySelectorAll(".drops").forEach(drop=>{
                drop.remove()
            })  
        }


genres.forEach(gen => {
    let p=document.createElement("p")
    p.className="drops";
    p.innerHTML=gen;
    holder.append(p)
});


if(document.querySelectorAll(".drops")){
    document.querySelectorAll(".drops").forEach(drop=>{
     drop.addEventListener("click",() =>{
        document.querySelector("#genre").value=drop.innerHTML;
        document.querySelector(".dropsHolder").innerHTML=''
     })
    
    })  
} 
    });


  

}


//book.blade.php
if (document.querySelectorAll(".book-entry")) {
    

    
    //reducing number of Admin books
    
    let books=document.querySelectorAll(".book-entry");
    
    for (let i = 12; i < books.length; i++) {
      const book = books[i];
      book.style.display="none"
    }
    
    
 

    //reducing user books
      
    let user_books=document.querySelectorAll(".book-entry-norms");
    
    for (let i = 12; i < user_books.length; i++) {
      const book = user_books[i];
      book.style.display="none"
    }
    
    
    //veiwing more user_books
    let u_more=document.querySelector("#u-more");
    u_more.addEventListener("click",function () {
      let user_books=document.querySelectorAll(".book-entry-norms");
      for (let i = 0; i < user_books.length; i++) {
      const book = user_books[i];
      book.style.display="block"
    }
    u_more.style.display="none";
    document.querySelector("#u-less").style.display='block';
    })
    
    //viewing less user_books
    let u_less=document.querySelector("#u-less");
    u_less.addEventListener("click",function () {
      let user_books=document.querySelectorAll(".book-entry-norms");
      for (let i = 12; i < user_books.length; i++) {
      const book = user_books[i];
      book.style.display="none"
    }
    u_less.style.display="none"
    document.querySelector("#u-more").style.display="block"
    })






//input holding @csrf applicable to all
 let csrf=document.querySelectorAll("input")[1]

       //for deleting Books uploaded by admin
       const deletes=document.querySelectorAll(".delete")
       
          deletes.forEach(element => {
        
       
       
        
       
           element.addEventListener("click",() =>{
             //showing popup
             document.querySelector("#overlay").style.display="block"
             document.querySelector("#popup-container").style.display="block";
       
             document.querySelector("#popup-container").querySelector("h2").innerHTML="Are You Sure"
             //removing textarea
       
             document.querySelector("#popup-input").style.display="none"
       
              //cancelling
       
             document.querySelector(".cancel").addEventListener("click",function (params) {
               document.querySelector("#overlay").style.display="none"
       
                       document.querySelector("#popup-container").style.display="none";
             })
       
       
             document.querySelector(".proceed").addEventListener("click",()=>{
           
       let id=element.getAttribute('ct')
       let book_title=element.getAttribute('title')
           fetch(`/delete_book/${id}`,{
           method:"DELETE",
           headers: {
                   'Content-Type': 'application/json',
                   'X-CSRF-TOKEN':csrf.value,
               },
         })
           .then((response)=>{
             if (!response.ok) {throw new Error('Network response was not ok');}
               return response.json();
         }).then(data=>{
           element.parentElement.parentElement.remove()
           document.querySelector(".alert2").style.display="block"
           document.querySelector(".alert2").innerHTML=data.message;
          
           document.querySelector("#overlay").style.display="none"
             document.querySelector("#popup-container").style.display="none";
       
       
           setTimeout(() => {
         document.querySelector(".alert2").style.display='none'
       }, 2100);

       let boks
      if (element.id =="user") {
      boks=document.querySelectorAll(".book-entry-norms");
      
      }else{
        boks=document.querySelectorAll(".book-entry");
      }
      for (let i = 0; i < boks.length; i++) {
        const book = boks[i];
        if(book.style.display==="none"){
            book.style.display="block"
            break
        }  
      } 
      
         }) 
           
       //remove success message after 2s
       if (document.querySelector(".alert")) {
       
       setTimeout(() => {
         document.querySelector(".alert").style.display='none'
       }, 2100);
       }
    })
       
});});
       
       
       
       //deleting books uploaded by norms temporaly(soft delete)
       
       
       const delete_norms=document.querySelectorAll(".delete-norms")
       
          delete_norms.forEach(element => {
        
           element.addEventListener("click",() =>{
             let id=element.getAttribute("ct");
             let user_id=element.getAttribute("user_id");
       
       
             //adding popup
             document.querySelector("#overlay").style.display="block"
       
             document.querySelector("#popup-container").style.display="block";
             document.querySelector("#popup-input").focus();
       
             //cancelling
       
             document.querySelector(".cancel").addEventListener("click",function (params) {
               document.querySelector("#overlay").style.display="none"
       
                       document.querySelector("#popup-container").style.display="none";
             })
             document.querySelector("#popup-input").style.display="block"
       
           document.querySelector(".proceed").addEventListener('click',()=>{
             let popup_input=document.querySelector("#popup-input").value;
       
             if (popup_input.length == ' ') {
               document.querySelector(".err").innerHTML="Enter A value"
             }else{
       
               let id=element.getAttribute('ct')
              
       
                 let data={
                
                   book_id:id,
                   reason:popup_input,
                   
                 }
                     
                     fetch(`/removebook`,{
                     method:"POST",
                     headers: {
                           
                             'X-CSRF-TOKEN':csrf.value,
                         },  
                         body: JSON.stringify(data)
                   })
                     .then((response)=>{
                       if (!response.ok) {throw new Error('Network response was not ok');}
                       response.json();
                   }).then(data=>{
       
                     //removing popup
                     document.querySelector("#overlay").style.display="none"
       
                       document.querySelector("#popup-container").style.display="none";
       
                       let div=document.createElement("div");
                       div.className="blur"
       
                       const parent=element.parentElement.parentElement
                       document.querySelector("#popup-input").value=' '
                     parent.append(div)
       
                       element.style.display="none";
       
                     parent.querySelector(".nice-buttons").style.display="flex";
       
                   
       
                       })
                     }
                     })
         
       
           
           })
           })
         
       
       
       // restoring books
       
       
       const restore=document.querySelectorAll(".restore")
       
          restore.forEach(element => {
       
           element.addEventListener("click",() =>{
             let id=element.getAttribute('ct')
             let data={
         book_id:id,
       
       }
          
       
           fetch(`/restore_book/`,{
           method:"POST",
           headers: {
                   'Content-Type': 'application/json',
                   'X-CSRF-TOKEN':csrf.value,
               },
               body:JSON.stringify(data)
       
         })
           .then((response)=>{
             if (!response.ok) {throw new Error('Network response was not ok');}
                response.json();
         }).then(data=>{
           const parent=element.parentElement.parentElement
          parent.querySelector(".blur").remove()
       
          parent.querySelector(".book-buttons").style.display="flex";
          parent.querySelector(".delete-norms").style.display="block"
          parent.querySelector(".nice-buttons").style.display="none";
             
       });
       
          })
         });
       
     
         
         /// clicking on the genres
         melf()

      function melf(params) {
        let tfs= document.querySelectorAll(".tf");
        tfs.forEach(tf => {
          tf.addEventListener('click',()=>{
            tfs.forEach(f => {
              f.classList.remove('now')
            });

            tf.classList.add('now')

            let docs=document.querySelectorAll('.book-entry-norms');

            if (tf.innerHTML==="All") {
              for (let i = 0; i <docs.length; i++) {
                const book = docs[i];
                book.style.display="none"
              }
              for (let i = 0; i <12; i++) {
                const book = docs[i];
                book.style.display="block"
              }
            }else{

      
            //showing post of the genre click

          
            docs.forEach(doc => {
              let genre=doc.querySelector(".genre");
              if (genre.innerHTML === tf.innerHTML) {
                doc.style.display="block"
              }else{
                doc.style.display="none" 
              }
            });
          }

          })
        });

      }

//doing live search for the search input

}