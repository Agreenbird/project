;(function(){
    'use strict'

    var el_product_form = document.querySelector('#product-form');
    var el_product_list = document.querySelector('#product-list');
    var el_cat_option = document.querySelector('[name=cat_id]');
    var cat_list = [];
    var product_list = [];

init();
function init(){
    get_form_cat();
    get_form_product();
    el_product_form.addEventListener('submit',function(e){
        e.preventDefault();
    })
}
function get_form_cat(){
    $.get('../api/gateway.php/?model=cat&action=read')
        .then(function(data){
            cat_list = data;
            render_cat_option();
        })
}
function get_form_product(){
    $.get('../api/gateway.php/?model=product&action=read')
        .then(function(res){
            product_list=res.data;
            render_product_list();
           
        })
}
function remove_product(id){
    $.post('../api/gateway.php/?model=product&action=remove',{id:id})
        .then(function(res){
            if(res.success){
                get_form_product();
                render_product_list();
            }
        })
}
function set_from_data(el,data){
    // var data = {};
    // var input_list = el.querySelector(['name']);
    // input_list.forEach(input){
    //     var value = input.value;
    //     var key = input.name;
    //     data[key]=value;
    // }
    // return data;
    for(var key in data){
        var input = el.querySelector(`[name=${key}]`);
        if(!input){
            continue;
        }
        input.value = data[key];
    }
}
function render_cat_option(){
    el_cat_option.innerHTML = '';
     cat_list.forEach(function(cat){
         var option = document.createElement('option');
         option.value = cat.id;
         option.innerHTML = cat.title;
         el_cat_option.appendChild(option);
     })
}
function render_product_list(){
    el_product_list.innerHTML = '';
    product_list.forEach(function(product){
        var el = document.createElement('div');
        el.innerHTML = `
        <strong>${product.title}</strong>
        <div>${product.price}</div>
        <div>${product.stock}</div>
        <button id = remove-btn>删除</button>
        <button id = update-btn>更新</button>
        <hr/>
        `;
        var remove_btn = el.querySelector('#remove-btn');
        var update_btn = el.querySelector('#update-btn');
        
        remove_btn.addEventListener('click',function(){
            remove_product(product.id);
        })
        update_btn.addEventListener('click',function(){
            set_from_data(el_product_form,product);
        })

        el_product_form.appendChild(el);
    })
}
})();