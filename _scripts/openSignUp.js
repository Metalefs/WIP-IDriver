
    var btn = document.getElementById("scroll");
    var scr = document.getElementById("corpo");
    var ssu = document.getElementById("signup");
    var begra = document.getElementById("begra");    
    var corpo = document.getElementById("top");    
    var insc = document.getElementById("insc");
    var loginBtn = document.getElementById("login-href");

    var suisOpen = false;
        
        function signup(){
            console.log("click!")
            if(suisOpen==false){
                ssu.className = "show-signup";
                begra.className = "begra-show";
                suisOpen=true;
                btn.innerHTML = "X";
                
                loginBtn.style.visibility="hidden";
                loginBtn.style.display="none";
            } else {
                ssu.className = "hide-signup";
                begra.className = "begra-hide";
                suisOpen=false;
                btn.innerHTML = "Comece Hoje";
                
                loginBtn.style.visibility="visible";
                loginBtn.style.display="initial";
            }
        }
        
        corpo.addEventListener('click',function(){
            if(suisOpen==true){
                ssu.className = "hide-signup";
                begra.className = "begra-hide";
                btn.innerHTML = "Comece Hoje";
                suisOpen=false;
            }
        });
        insc.addEventListener('click',function(){
            if(suisOpen==true){
                ssu.className = "show-signup";
                begra.className = "begra-show";  
                suisOpen=false;
            }
        });
        begra.addEventListener('click',function(){
            if(suisOpen==true){
                ssu.className = "hide-signup";
                begra.className = "begra-hide";
                btn.innerHTML = "Comece Hoje";
                suisOpen=false;
            }
        });
   