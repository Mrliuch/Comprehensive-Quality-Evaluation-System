function change_pic1(){
    var obj = document.getElementById("left");   
    if (obj.getAttribute("src") == "1.1.jpg") {
        obj.setAttribute("src", "2.1.jpg");     
    } else { 
        obj.setAttribute("src", "1.1.jpg"); 
    }
     }
function change_pic2(){
    var obj = document.getElementById("left");   
    if (obj.getAttribute("src") == "2.1.jpg") {
        obj.setAttribute("src", "1.1.jpg");     
    } else { 
        obj.setAttribute("src", "2.1.jpg"); 
    }
     }
function change_pic3(){
    var obj = document.getElementById("right");   
    if (obj.getAttribute("src") == "1.2.jpg") {
        obj.setAttribute("src", "2.2.jpg");     
    } else { 
        obj.setAttribute("src", "1.2.jpg"); 
    }
     }
function change_pic4(){
    var obj = document.getElementById("right");   
    if (obj.getAttribute("src") == "2.2.jpg") {
        obj.setAttribute("src", "1.2.jpg");     
    } else { 
        obj.setAttribute("src", "2.2.jpg"); 
    }
     }