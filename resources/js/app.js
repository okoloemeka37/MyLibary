import './bootstrap';


// When the user scrolls the page, execute myFunction

window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.querySelector(".secondNav");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}








if (document.querySelectorAll(".flat")) {


  let counter=0;

  let current=0
 

let flats =document.querySelectorAll(".flat");

flats[0].style.display='block';

setInterval(()=>{
if (counter == -1) {
  flats[2].style.display="none";
  counter=0
}else{
  flats[counter].style.display="none";
  counter++;
}
  


  
  flats[counter].style.display="block";

 

  if (counter === 2) {
    
    counter=-1;
  
  }


},7000)

}



// posts slide show
let gr=document.querySelector(".gr");
if (document.querySelectorAll(".tm")) {

  // doing the forward reaction 



  let books=document.querySelectorAll(".tm");
  for (let bk = 0; bk <5; bk++) {
   let bt=books[bk] 
gr.append(bt)
books[bk].style.display="block"; 
  }

 let plus=document.querySelector("#plus");
 let present=0;
 let future=5;
 plus.addEventListener("click",function (params) {


  

  books[present].style.display="none"; 
  books[present].remove();
  present++;

  document.querySelector(".gr").classList.add('gy')



 

  books[future].classList.add('rev')
  gr.append(books[future])

  books[future].style.display="block"; 
  future++
   
 
setTimeout(() => {
   document.querySelector(".gr").classList.remove('gy')
}, 500);
 







if (future === 11) {
  future=0
}
if (present ===11) {
  present=0
}



 })
  
// finished the forward reaction 

// starting the backward reaction

let minus= document.querySelector("#minus");
let fow=4;
  let pat=10;
minus.addEventListener("click",()=>{

  


  books[fow].style.display="none"; 
  books[fow].remove();
  fow--;

  document.querySelector(".gr").classList.add('gm');

  //getting the first present child
  let fc= document.querySelector(".gr").children[0];

  books[pat].style.display="block"; 
  books[pat].classList.add('res')
  document.querySelector(".gr").insertBefore(books[pat],fc)
  pat--

  setTimeout(() => {
    document.querySelector(".gr").classList.remove('gm');
  }, 500);



  if (fow==-1) {
    fow=10
  }
  if (pat ==-1) {
    pat=10
  }
})



//adding automatic slides

setInterval(() => {
  

  books[present].style.display="none"; 
  books[present].remove();
  present++;

  document.querySelector(".gr").classList.add('gy')



 

  books[future].classList.add('rev')
  gr.append(books[future])

  books[future].style.display="block"; 
  future++
   
 
setTimeout(() => {
   document.querySelector(".gr").classList.remove('gy')
}, 500);
 







if (future === 11) {
  future=0
}
if (present ===11) {
  present=0
}

}, 5000);
}




// slide for red background near penny wise


  console.log("jrej")
  let counter=0;

  let current=0
 

let sf =document.querySelectorAll(".sf");


sf[0].style.display='flex';

setInterval(()=>{
if (counter == -1) {
  sf[2].style.display="none";
  counter=0
}else{
  sf[counter].style.display="none";
  counter++;
}
  


  sf[counter].classList.add('swip')
  sf[counter].style.display="flex";

 

  if (counter === 2) {
    
    counter=-1;
  
  }
},4000)

