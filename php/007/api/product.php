<?php
class Product
{
    public $db;
    public function __construct($db){
       $this->db=$db;
    }
    public function add($row){
        $title = $row['title'];
        $price = $row['price'];
        $stock = $row['stock'];
        $cat_id = $row['cat_id'] ?:0 ;
        //判断
        $db = $this->db;
        $sql = $db->prepare("
        insert into product 
        (title, price, stock,cat_id) 
        value ('{$title}','{$price}', '{$stock}', '{$cat_id}')");
        $r = $sql->execute();
        return $r ?
        ['success' => true] :
        ['success' => false, 'msg' => 'db_internal_error'];
    }
    public function remove($row){
        $id = $row['id'];
        if(!is_numeric($id)){
            return ['success'=>false,'msg'=>'id没有'];
        }
        $r = $this->db->prepare('delete from product where id=:id')
                    ->execute(['id'=>$id]);
        return $r ?
        ['success'=>true]:
        ['success'=>false,'mag'=>'db_internal_error'];
    }
    public function update($row){
        $id=$row['id'];
        if(!is_numeric($id)){
            return ['success'=>false,'msg'=>'id没有'];
        }
        $statement = $this->db->prepare('select * from product where id = :id');
        $statement->execute(['id' => $id]);
        $old = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$old){
            return ['success'=>false,'msg'=>'invlid id'];
        }
        $merged = array_merge($old, $row);
        $this->db->prepare('update product set title=:title, price=:price, cover_src=:cover_src, stock=:stock, des=:des, cat_id=:cat_id, data=:data where id = :id')
          ->execute($merged);

    }
    public function read($a=[]){
        //参数给个默认值
        $id=@$a['id'];
        if($id){
            $r=$this->db->prepare('select * from product where id = :id')
                ->execute(['id'=>$id]);
                return $r ?  
                ['success'=>true]:
                ['success'=>false,'msg'=>'没找到'];
        }else{
            $page =(int) @$_GET['page'] ? :1;
            $limit = 10;
            $setOff = $limit * ($page - 1);
            $r= $this->db->prepare('select * from product limit :setOff ,:limit');
            $r->execute([
                    'limit'=>$limit,
                    'setOff'=>$setOff,
                 ]);
        }
       
        return $r->fetchAll(PDO::FETCH_ASSOC);

       //$r=$this->db->prepare('select * from product limit where id = :id)
       //  $r= execute(['id'=>$id]);
       //return $r 
    
    }

}
// $product = new Product();
// var_dump($product->add([
//     'title'=>'test'.rand(1,30),
//     'price'=>rand(500,9999),
//     'stock'=>rand(20,50),
//     'cat_id'=>rand(20,50),
// ]));
// var_dump($product->read());

?>