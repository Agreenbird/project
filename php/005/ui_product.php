<?php
    require_once("api_product.php");
    $list =$p->read();
  
?>
<!DOCTYPE html>
<html lang="zh-ch">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width="device-width", initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img{
            width:100px;
            
        }
        a{
            text-decoration: none;
            padding:3px;
            background:#029AE5;
            color:#ffffff;
           
        }
    </style>
</head>
<body>
<div>
    <form action="api_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add" >
        <input type="text" name="title">
        <br/>
        <input type="text" name="price">
        <br/>
        <input type="file" name="cover">
        <br/>
        <button type="submit">提交</button>
    </form>
</div>
<div id="list-prodcut">
    <?php foreach ($list as $product): ?>
       <div>
            <div><img src='./image/<?php echo $product['cover_name']?>'></div>
            <div><?php echo $product['title'] ?></div>
            <div><?php echo $product['price'] ?></div>
            <br/>
            <a href="api_product.php?action=remove&id=<?php echo @$product['id']?>">删除</a>
            <a href="">更改</a>
        </div>
        <hr/>
    <?php endforeach; ?>
</div>
</body>
</html>