<!DOCTYPE html>
<html lang="zn-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form id="product-form">
    <input type="text" name="title" >
    <input type="text" name="price" >
    <button type="submit">提交</button>
</form>  
<div id="list-product">

</div> 
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script> 
<script>
    var el_form = document.querySelector('#product-form');
    var el_list = document.querySelector('#list-product');
    var input_title = document.querySelector('[name=title]')
    var input_price = document.querySelector('[name=price]')
    var product_list = [];

    el_form.addEventListener("submit",function(e){
        e.preventDefault();
        var product = {};
        product.title = input_title.value;
        var val = input_price.value;
        product.price =parseFloat(val);
        $.post('welcome.php',product)
    });

   </script>
</body>
</html>