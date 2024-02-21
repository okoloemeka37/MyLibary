export function imagePreviewer(fake,previewer,input) {
    


fake.addEventListener("click",()=>{
input.click();
  })

  let uploadInput=input
  
  uploadInput.addEventListener("change",()=>{
  
  let file=uploadInput.files[0];
  let reader=new FileReader();
  reader.onload=(e)=>{
  
  let img =previewer
  img.style.display="block";
    
    img.src = e.target.result;
                    
  } 
  reader.readAsDataURL(file)
  
  
  }) 
  
}