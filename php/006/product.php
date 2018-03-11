<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>商品管理</h1>
<div>
    <form id="product-form">
        <label>
            <input type="hidden" name="id" >
        </label>
        <label>
            title:
            <input type="text" name="title">
        </label><br/>
        <label>
            price:
            <input type="text" name="price">
        </label><br/>
        <label>
           stock:
            <input type="text" name="stock">
        </label><br/>
        <label>
           cat_id:
           <select name="cat_id"></select>
        </label><br/>
        <button type="submit">提交</button>
        
    </form>
</div>
<div id="product-list"></div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="public/js/product.js"></script>
    
</body>
</html>