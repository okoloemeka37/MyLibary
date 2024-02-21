
if (document.querySelector(".check")) {
    let check=document.querySelector(".check");
    if (check.innerHTML=="Transaction sucessfull") {
        document.querySelector("#popup-container").style.display="block"
        document.querySelector("#overlay").style.display="block"
        document.querySelector(".alert2").style.display="block"
        setTimeout(() => {
            document.querySelector(".down").click()
            document.querySelector(".alert2").style.display="none"
        }, 1500);
      
    }
    
    check=document.querySelector(".proceed").addEventListener("click",()=>{
        document.querySelector("#popup-container").style.display="none"
        document.querySelector("#overlay").style.display="none"
    })
    
    
    
    document.querySelector(".down").addEventListener('click',()=>{
        document.querySelector("#popup-container").style.display="block"
        document.querySelector("#overlay").style.display="block"
        document.querySelector(".alert2").style.display="block"
    })
}


let table=document.querySelector(".table").getAttribute('name');



//code for comment section

let btn=document.querySelector(".Add_comment")
let csrf=document.querySelectorAll("input")[0]
btn.addEventListener("click",(e)=>{
    
   e.preventDefault();
   let content=document.querySelector(".content");
   console.log(content)
   let book_id=document.querySelector(".item_id").value;
   let title=document.querySelector(".gb").innerHTML;
   let owner=document.querySelector(".owner").value;
   let parent_id=document.querySelector(".parent_id").value;
   let data={
    'content':content.value,
    'item_id':book_id,
    'parent_id':parent_id,
    'owner_id':owner,
    'title':title,
    'table':table
}
 if (content.value.length===0) {
    document.querySelector(".com_err").innerHTML="Enter A Comment";
 }else{
    fetch(`/Add_comment`,{
        method:"POST",
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':csrf.value
        },
        body:JSON.stringify(data)
    }).then(
        get(),
    
        document.querySelector(".content").value=" "
    )
    
 }
})
get()
function get(params) {
    let item_id=document.querySelector(".item_id").value;
    let data={
       'id':item_id,
        'table':table
    }
fetch('/get_comment',{
    method:"POST",
    headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN':csrf.value
    },
    body:JSON.stringify(data)

}).then(resp=>resp.text())
.then(data=>{
        document.querySelector(".comments").innerHTML=data;
        setTimeout(() => {
            reply() 
            edit()
            del()
         }, 1000);
})
}
//setting the reply button

function reply(params) {
    let reply_btn=document.querySelectorAll(".reply-btn");
    
    reply_btn.forEach(btn => {
        btn.addEventListener('click',()=>{
           let content= document.querySelector(".content");
           content.focus();
           content.setAttribute("placeholder","Enter Reply");
           document.querySelector(".parent_id").value=btn.id
        })
    });     
}


  //editng comment done

    function edit(params) {
        let edits=document.querySelectorAll(".edit-btn");
       edits.forEach(btn => {
        btn.addEventListener("click",()=>{
            document.querySelector(".ed_id").value=btn.id
            let txt=btn.parentElement.querySelector(".rg").value
            let content= document.querySelector(".content");
            content.focus();
            content.value=txt;
            document.querySelector(".edit_comment").style.display="block";
            document.querySelector(".Add_comment").style.display="none"
            sub_edit()
        })
       });
    }

    function sub_edit(params) {
        document.querySelector(".edit_comment").addEventListener("click",()=>{
            let content= document.querySelector(".content")
            
             let comment_id=document.querySelector(".ed_id").value;
           

             let data={
                'content':content.value,
                'comment_id':comment_id
            }
             if (content.value.length===0) {
                document.querySelector(".com_err").innerHTML="Enter A Comment";
             }else{
                fetch(`/edit_comment`,{
                    method:"POST",
                    headers:{
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN':csrf.value
                    },
                    body:JSON.stringify(data)
                }).then(
                    get(),
                    document.querySelector(".edit_comment").style.display="none",
                    document.querySelector(".Add_comment").style.display="block",
                    document.querySelector(".content").value=" "
                )
                
             }
        })
    }

    //deleting comment
function del(params) {
    let dels=document.querySelectorAll(".delete-btn");
    dels.forEach(det=>{
        det.addEventListener("click",()=>{
          let id=det.id;
            fetch("/delete_comment/"+id,{
                method:"DELETE",
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':csrf.value
                },
            }).then( get(),)
        })
    })
}
  
     


//ratings function

if (document.querySelectorAll(".star")[0]) {
    

let rating_btns=document.querySelectorAll(".star");
rating_btns.forEach(btn => {
    btn.addEventListener("click",()=>{
        let id=btn.id;
        if (id==1) {
            btn.classList.replace("fa-regular","fa-solid")
            for (let index = id; index < rating_btns.length; index++) {
               
                rating_btns[index].classList= "fa-regular fa-star star";
                
            }
        }else{
            for (let index = id-1; index > -1; index--) {
               
                rating_btns[index].classList.replace("fa-regular","fa-solid")
                
            }
            for (let index = id; index < rating_btns.length; index++) {
               
                rating_btns[index].classList= "fa-regular fa-star star";
                
            }
        }
        
        let book_id=document.querySelector(".book_id").value;

        let data={
            'book_id':book_id,
            'rate':id,
           
        }
        
        fetch("/add_rating",{
            method:"POST",
            headers:{
                'Content-Type':"application/json",
                'X-CSRF-TOKEN':csrf.value
            },
            body:JSON.stringify(data)
        }).then( other_rating())


    })
});

p_rate()
//get p_rating
function p_rate() {
    let book_id=document.querySelector(".item_id").value;
    fetch("/p_get_rating/"+book_id,{
        method:"GET",
        headers:{
            'Content-Type':"application/json",
            'X-CSRF-TOKEN':csrf.value
        },
       
    }).then(resp=>resp.json())
    .then(data=>{
       if (data['rating'].length===0) {
        
       }else{
        let id=data['rating'][0]['rate'];
        if (id==1) {
            rating_btns[0].classList.replace("fa-regular","fa-solid")
           
        }else{
            for (let index = id-1; index > -1; index--) {
               
                rating_btns[index].classList.replace("fa-regular","fa-solid")
                
            }
            for (let index = id; index < rating_btns.length; index++) {
               
                rating_btns[index].classList= "fa-regular fa-star star";
                
            }
        }
    }
   
    })

}

other_rating();

function other_rating(){
    let book_id=document.querySelector(".item_id").value;
    let rates=document.querySelector(".num_rates");
    let raters=document.querySelector(".num_raters");

    fetch("/other_rating/"+book_id,{
        method:"GET",
        headers:{
            'Content-Type':"application/json",
            'X-CSRF-TOKEN':csrf.value
        },
       
    }).then(resp=>resp.json())
    .then(data=>{
      


        raters.innerHTML=data['rating'].length;
        let som=0
        data['rating'].forEach(sot => {
         som += sot['rate'];
         
       if (som>20 && som < 101) {
        if (som <=80) {
           
            document.querySelector("#h1").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
       }}

       if (som>120 && som < 201) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        if (som <=180) {
           
            document.querySelector("#h2").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
       }}

       if (som>220 && som < 301) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
        if (som <=280) {
           
            document.querySelector("#h3").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h3").classList.replace("fa-regular","fa-solid")
       }}

       if (som>320 && som < 480) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h3").classList.replace("fa-regular","fa-solid")
        if (som <=380) {
           
            document.querySelector("#h4").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h4").classList.replace("fa-regular","fa-solid")
       }}
       if (som>520) {
        document.querySelector("#h1").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h2").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h3").classList.replace("fa-regular","fa-solid")
        document.querySelector("#h4").classList.replace("fa-regular","fa-solid")
      
        if (som <=580) {
           
            document.querySelector("#h5").classList.add("fa-star","fa-star-half-stroke")
        }else{
        document.querySelector("#h5").classList.replace("fa-regular","fa-solid")
       }}




         if (som.toString().length >=4 && som.toString().length <=6) {
            let n_som=(som/1000).toFixed(1);
            rates.innerHTML=n_som+"K"
         }else if(som.toString().length >=6 ){
        rates.innerHTML=som+"M"
         }else{
            rates.innerHTML=som
         }
            
        });
    }) 
}

}