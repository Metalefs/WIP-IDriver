    var btn = document.getElementById("scroll");
    var scr = document.getElementById("corpo");
    var ssu = document.getElementById("signup");
    var begra = document.getElementById("begra");    
    var corpo = document.getElementById("top");    
    var insc = document.getElementById("insc");
        
    var suisOpen = false;
        
        function signup(){
            console.log("click!")
            if(suisOpen==false){
                ssu.className = "show-signup";
                begra.className = "begra-show";
                suisOpen=true;
                btn.innerHTML = "X";
            } else {
                ssu.className = "hide-signup";
                begra.className = "begra-hide";
                suisOpen=false;
                btn.innerHTML = "Comece Hoje";
            }
        }
        
        corpo.addEventListener('click',function(){
            if(suisOpen==false){
                ssu.className = "hide-signup";
                begra.className = "begra-hide";
                btn.innerHTML = "Comece Hoje";
                suisOpen=true;
            }
        });
        insc.addEventListener('click',function(){
            if(suisOpen==false){
                ssu.className = "show-signup";
                begra.className = "begra-show";  
                suisOpen=true;
            }
        });
        begra.addEventListener('click',function(){
            if(suisOpen==false){
                ssu.className = "hide-signup";
                begra.className = "begra-hide";
                btn.innerHTML = "Comece Hoje";
                suisOpen=true;
            }
        });