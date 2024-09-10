


// let p = document.querySelector('.p');
// let m = document.querySelector('.m');
// let count = document.querySelector('.pcount');

// let i = '0.0';
// count.value = i;


// p.addEventListener("click", function(){
//     this.count.value = ++i;
// })


// m.addEventListener("click", function(){
//     if(i>0){
//         count.value = --i;
//     }

// })
// const counters = document.querySelectorAll(['data-counter']);

// if(counters){
//     counters.forEach(counter => {
//         counter.addEventListener('click', e => {
//             const target = e.target;

//             if(target.closest('.bt')){
//                 let value = parseInt(target.closest('.actions')).querySelector('input').value;

//                 if(target.classList.contains('p')){
//                     ++value;
//                 }else{
//                     --value;
//                 }
//                 target.closest('.actions').querySelector('.input').value = value;
//             }
//         })
//     })
// }

// let icons = document.querySelector('icons');


// icons.addEventListener("click", function(e){
//     icons.onclick = (e) => {
//         console.log(e.target.getAttrebute("id"));
//     }
// })


// $('.icons .icon').on('click', addToCard);

// function addToCard(){
//     let id = $('.icon').attr('data-id')
//     console.log(id)
// }


// $('.pm').on('click', changeCountpcsm);
// $('.pp').on('click', changePlus)

// function changeCountpcsm(){
//     $('.count').val('99')
// }

// function changePlus(){
//     $('.count').text(77)
// }
//-----------------------------------------------------------
// minus = document.querySelector('[data-action="minus"]');
// plus = document.querySelector('[data-action="plus"]');
// counter = document.querySelector('[data-counter]');

// minus.addEventListener('click', function(){
//     if(parseInt(counter.innerText)>1){pcsprice
//         counter.innerText = --counter.innerText;
//     }

// });

// plus.addEventListener('click', function(){
//     counter.innerText = ++counter.innerText;
// })
//-----------------------------------------------------------

window.addEventListener('click', function (event) {

    let count;
    let result;
    let kgprice;
    let pcsprice;

    if (event.target.dataset.action === 'kgplus' || event.target.dataset.action === 'kgminus'
        || event.target.dataset.action === 'pminus' || event.target.dataset.action === 'pplus'
        || event.target.dataset.action === 'gminus' || event.target.dataset.action === 'gplus') {
        const counts = event.target.closest('.counts');
        const info = event.target.closest('.forInfo');

        count = counts.querySelector('[data-counter]');
        result = counts.querySelector('[data-result]');

        kgprice = info.querySelector('[data-kgprice]');
        pcsprice = info.querySelector('[data-pcsprice]');
        a = info.querySelector('[data-bascet]');
        pid = info.querySelector('[data-phpid]');
        puser = info.querySelector('[data-user]');
        file = info.querySelector('[data-file]');
    }
    

    if (event.target.dataset.action === 'kgplus') {
        console.log(puser.textContent);
        count.value = ++count.value;
        caunt = count.value;
        result.innerText = "price: " + ((+kgprice.innerText) * (+count.value)).toFixed(1);
        a.setAttribute("href", `./bascet.php?count=${count.value}&total=${((+kgprice.innerText) * 
            (+count.value)).toFixed(1)}&username=${puser.textContent}&id=${pid.textContent}&img=${file.textContent}`);
    }

    if (event.target.dataset.action === 'kgminus') {
        if (parseInt(count.value) > 0) {
            count.value = --count.value;
            result.innerText = "price: " + ((+kgprice.innerText) * (+count.value)).toFixed(1);
            a.setAttribute("href", `./bascet.php?count=${count.value}&total=${((+kgprice.innerText) * 
                (+count.value)).toFixed(1)}&username=${puser.textContent}&id=${pid.textContent}&img=${file.textContent}`);
        }

    }

    if (event.target.dataset.action === 'pminus') {
        if (parseInt(count.value) > 0) {
            count.value = --count.value;
            result.innerText = "price: " + ((+pcsprice.innerText) * (+count.value)).toFixed(1);
            a.setAttribute("href", `./bascet.php?count=${count.value}&total=${((+pcsprice.innerText) * 
                (+count.value)).toFixed(1)}&username=${puser.textContent}&id=${pid.textContent}&img=${file.textContent}`);
        }
    }

    if (event.target.dataset.action === 'pplus') {
        count.value = ++count.value;
        result.innerText = "price: " + ((+pcsprice.innerText) * (+count.value)).toFixed(1);
        a.setAttribute("href", `./bascet.php?count=${count.value}&total=${((+pcsprice.innerText) * 
            (+count.value)).toFixed(1)}&username=${puser.textContent}&id=${pid.textContent}&img=${file.textContent}`);
    }

    if (event.target.dataset.action === 'gplus') {
        count.value = (+count.value + 0.1).toFixed(1);
        result.innerText = "price: " + ((+kgprice.innerText) * (+count.value)).toFixed(1);
        a.setAttribute("href", `./bascet.php?count=${count.value}&total=${((+kgprice.innerText) * 
            (+count.value)).toFixed(1)}&username=${puser.textContent}&id=${pid.textContent}&img=${file.textContent}`);
    }

    if (event.target.dataset.action === 'gminus') {
        if (count.value > 0) {
            count.value = (+count.value - 0.1).toFixed(1);
            result.innerText = "price: " + ((+kgprice.innerText) * (+count.value)).toFixed(1);
            a.setAttribute("href", `./bascet.php?count=${count.value}&total=${((+kgprice.innerText) * 
                (+count.value)).toFixed(1)}&username=${puser.textContent}&id=${pid.textContent}&img=${file.textContent}`);
        }

    }

});