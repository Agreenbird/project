;(function () {
    'use strict';
  
    var el_form = document.querySelector('#product-form');
    var el_list = document.querySelector('#list-product');
    var input_title = el_form.querySelector('[name=title]');
    var input_price = el_form.querySelector('[name=price]');
    var product_list;
 
    init();
    function init(){
      var product = {};
      el_form.addEventListener('submit',function(e){
        e.preventDefault();
        product.title = input_title.value; 
        product.price = parseFloat(input_price.value);
       
        $.post('/product_add.php',product)
          .done(function(r){
          get_data();
          });
          
      });
    }

    function get_data(){
      $.get('/product_read.php')
        .done(function(r){
          product_list = r;
         render();
        });
    }

    function render(){
      el_list.innerHTML = '';
      product_list.forEach(function(product){
        var div = document.createElement('div');
        div.innerHTML = `
        <div>
        <b>${product.title}</b>
        <span>${product.price}</span>
        </div>
        `;
  
        el_list.appendChild(div);
      })
    }
  })();
  