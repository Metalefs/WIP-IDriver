    var eye = document.getElementById("eye");
    var passInput = document.getElementById("passw");
    var isOpen = false;
    var isHidden = true;
    
        eye.addEventListener("click",function(){
        console.log('click');
    
            if (isHidden == true){ 
                isHidden=false;
                eye.src="./_imagens/eye-show.png";
                console.log(isHidden);
                passInput.type="text";
                console.log(passInput.type);
                 
            } else  {
                isHidden = true;
                eye.src="./_imagens/eye-hidden.png";
                console.log(isHidden);
                passInput.type="password";
                console.log(passInput.type);
             }
    });