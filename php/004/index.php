<?php
require_once('./api_product.php');
$list = $p->read();
?>
<!DOCTYPE html>
<html lang="zh-ch">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
img{
    max-width:100px;
}
</style>
<body>
<div>
    <form action="api_product.php"
    enctype="multipart/form-data"
    method="post">
        <input type="hidden" value="add" name="action">
        <input type="text" name="title">
        <input type="text" name="price">
        <input type="file" name="cover">
        <button type="submit">提交</button>
    </form>    
</div>
    <div id="list-product">
        <?php foreach ($list as $product): ?>
            <div><img src="./image/<?php echo $product['cover_name']?>"></div>
            <div><?php echo $product['title'] ?></div>
            <br/>
            <div><?php echo $product['price'] ?></div>
            <br/>
            <a href="api_product.php/?action=remove&id=<?php echo $product['id'] ?>">删除</a>
            <hr/>
        <?php endforeach ;?>
    </div>
</body>
</html>