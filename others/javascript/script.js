$(document).ready(function(){
    $(".toggle").onclick(function(){
        $(".menu").toggleClass('showing');
        $("i").toggleClass("fa-bars").toggleClass("fa-times");
    });
});

/*const toggle = document.querySelector(".toggle");
const menu = document.querySelector(".menu");

//Toggle mobile menu
function toggleMenu(){
    if(menu.classList.contains("active")){
        menu.classList.remove("active");

        //adds the menu fa bars
        toggle.querySelector("a").innerHTML="<i class='fas fa-bars'></i>";
    }else{
        menu.classLiist.add("active");

        //adds the close(x) icon
        toggle.querySelector("a").innerHTML = "<i class='fas fa-times'></i>";
    }
}
/* Event Listener 
toggle.addEventListener("click", toggleMenu, false);*/