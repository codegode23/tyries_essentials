
let addcart = document.querySelector("#addcart");


let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active'); 
}


window.onscroll = () => {
    if(window.scrollY > 10) {
        document.querySelector('.header .header-2').classList.add('active');
    }else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
}