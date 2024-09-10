let id = document.getElementById('iconBascet');
let bascetContainer = document.getElementById('bascetContainer');
let select = document.querySelector('.select');
let alltotal = document.querySelector('.alltotal');
let alltotal1 = document.querySelector('.alltotal1');
let h6 = document.querySelector('.h6');

id.addEventListener('click', bascetOpen);

function bascetOpen (){
    if(bascetContainer.classList.contains('bascetnone')){
        bascetContainer.classList.remove('bascetnone');
        bascetContainer.classList.add('bascetInline');
    }else{
        bascetContainer.classList.remove('bascetInline');
        bascetContainer.classList.add('bascetnone');
    }
}

// id.removeEventListener('click', bascetOpen);

select.addEventListener('click', function(){
    if(select.options[select.selectedIndex].value == 'USD'){
        if(h6.textContent == 'рубли'){
            alltotal.textContent = (+alltotal.textContent / 83.51).toFixed(1);
            h6.textContent = 'dollar';
        }else if(h6.textContent == 'դրամ'){
            alltotal.textContent = (+alltotal.textContent / 385).toFixed(1);
            h6.textContent = 'dollar';
        }
    }

    if(select.options[select.selectedIndex].value == 'AMD'){
        if(h6.textContent == 'рубли'){
            alltotal.innerHTML = alltotal1.textContent;
            h6.textContent = 'դրամ';
        }else if(h6.textContent == 'dollar'){
            alltotal.innerHTML = alltotal1.textContent;
            h6.textContent = 'դրամ';
        }
    }

    if(select.options[select.selectedIndex].value == 'RUB'){
        if(h6.textContent == 'dollar'){
            alltotal.textContent = (+alltotal.textContent * 83.51).toFixed(1);
            h6.textContent = 'рубли';
        }else if(h6.textContent == 'դրամ'){
            alltotal.textContent = (+alltotal.textContent / 4.2).toFixed(1);
            h6.textContent = 'рубли';
        }
    }
})

