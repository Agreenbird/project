<?php
    $product_list = [];
    $product_list = json_decode(file_get_contents('./data.json'));

    $title = $_POST['title'];
    $price = $_POST['price'];

    
    $product_list[] = [
        'title' => $title,
        'price' => $price,
    ];
   
   
    file_put_contents('./data.json',json_encode($product_list));
  
