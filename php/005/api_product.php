<?php
// require_one('./helper.php');
class Product
{
    public $product_list;
    public $last_id;

    public $product_list_src = 'data/product_list.json';
    public $last_id_src = 'data/last_id.json';

    public function __construct(){
        $this->read();
        $parmas = array_merge($_POST,$_GET);
        $action = @$parmas['action'];
        if($action){
           $this->$action();
        }
    }
    public function add(){
        $title = $_POST['title'];
        $price = $_POST['price'];
        $cover = $_FILES['cover']['tmp_name'];
        //加判断
        if(!$title || !$price || !$cover){
            return ['success'=>false ,'msg'=>'invalid:title||price||cover'];
        }
        $cover_name = time().rand(1000,9999).'.jpg';
        move_uploaded_file($cover,'./image/'.$cover_name);

        $this->product_list[] = [
            'id' => $this->inc(),
            'title' =>$title,
            'price' =>$price,
            'cover_name' =>$cover_name,
        ];

        $this->sync();
        return ['success'=>true];
    }
    public function remove(){
        $id = $this->GET['id'];
        $index=$this->findIndex($id);
        array_splice($this->product_list,$index,1);
        $this->sync();
    }
    public function update(){
        
    }
    public function findIndex($id){
        foreach($this->product_list as $index=>$product){
            if($id==@$product['id']){
                return $index;
            };
        }
    }
    public function read(){
        $json= file_get_contents($this->product_list_src);
        $this->product_list = json_decode($json,true);
        $this->last_id = json_decode(file_get_contents($this->last_id_src));
        return $this->product_list;
    }
    public function sync(){
        $json = json_encode($this->product_list);
        file_put_contents($this->product_list_src,$json);
    }
    public function inc(){
    
        $this->last_id ++;
        file_put_contents($this->last_id_src,json_encode($this->last_id));
        return $this->last_id;
    }

}
$p = new Product;