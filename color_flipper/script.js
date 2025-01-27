
let flip_btn = document.querySelector('#flip');
let color_hex = document.querySelector('#color');
let body = document.body;
flip_btn.addEventListener("click",function(){
body.style.background=hex();
color_hex.innerHTML = hex();
});

function hex(){

let hex = '#' + Math.floor(Math.random()*16777215).toString(16); 

return hex; 
}
