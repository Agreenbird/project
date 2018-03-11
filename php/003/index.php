<?php
class Product
{
    public $product_list;
    public $parmas;
    public $file_path='./data.json';
    public function __construct(){
        $this->product_list=file_get_contents($file_path);
        $this->parmas=array_merge($_GET,$_POST);
        $action = $this->parmas['action'];
        $result = $this->$action();
        echo $this->json($result);
        
    }
    public function add(){
         $title = $this->parmas['title'];
         $price = $this->parmas['price'];
         $this->product_list[] = [
             'title' => $title,
             'price' => $price,
         ];
         $this->sync();
         return ['success'=> true];
    }
    public function sync(){
         file_put_contents($file_path,$this->product_list);

    }
    public function json(){
         
    }
}