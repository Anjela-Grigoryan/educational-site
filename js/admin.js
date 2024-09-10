let rsale = document.querySelector('.rSale');
let isale = document.querySelector('.saleInput');
let dsale = document.querySelector('.sale');

let kg = document.getElementById('kg');
let pcs = document.getElementById('pcs');
let inptKG = document.getElementById('inptKG');
let inptPCS = document.getElementById('inptPCS');


kg.addEventListener("click", function(){
    inptKG.style.display = "inline-block";
    inptPCS.style.display = "none";
})

pcs.addEventListener("click", function(){
    inptPCS.style.display = "inline-block";
    inptKG.style.display = "none";
})

rsale.addEventListener("click", function(){
    isale.style.display = "block";
})
