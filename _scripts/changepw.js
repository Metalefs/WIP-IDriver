    var eye = document.getElementById("eye");
    var eye2 = document.getElementById("eye2");
    var passInput = document.getElementById("passw");
    var passInput2 = document.getElementById("pass-top");
    var isOpen = false;
    var isHidden = true;
    var isOpen2 = false;
    var isHidden2 = true;
    
    
        eye.addEventListener("click",function(){
        console.log('click');
    
            if (isHidden == true){ 
                isHidden=false;
                eye.src="./_imagens/eye-show.png";
             //   console.log(isHidden);
                passInput.type="text";
             //   console.log(passInput.type);
                 
            } else  {
                isHidden = true;
                eye.src="./_imagens/eye-hidden.png";
             //   console.log(isHidden);
                passInput.type="password";
             //   console.log(passInput.type);
             }
    });
        eye2.addEventListener("click",function(){
        console.log('click');
    
            if (isHidden2 == true){ 
                isHidden2=false;
                eye2.src="./_imagens/eye-show.png";
              //  console.log(isHidden2);
                passInput2.type="text";
              //  console.log(passInput2.type);
                 
            } else  {
                isHidden2 = true;
                eye2.src="./_imagens/eye-hidden.png";
              //  console.log(isHidden2);
                passInput2.type="password";
               // console.log(passInput2.type);
             }
    });
    
    