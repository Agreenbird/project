<?php
$product_list = [];

init();
function init(){
  global $product_list;
  $product_list = json_decode(file_get_contents('data.json'));
  add();
}
function add(){
  global $product_list;
  $title = $_POST['title'];
  $price = $_POST['price'];

  $product_list[] = [
    'title' => $title,
    'price' => $price,
  ];
  sync();
  
}
function sync(){
  global $product_list;
  file_put_contents('data.json',json_encode($product_list));
}


