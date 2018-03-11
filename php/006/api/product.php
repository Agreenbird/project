<?php
class Product
{
  public $db;
  public function __construct($db){
    $this->db=$db;
  }
  //增
  public function add($row){
    $title = @$row['title'];
    $price = @$row['price'];
    $stock = @$row['stock'];
    $cat_id = @$row['cat_id'];
    //判断
    if(!$title || !$price || !$stock || !$cat_id){
      return ['success'=>false,'msg'=>'function(add) not exist'];
    }
    if(!is_numeric($price)||!is_numeric($stock)||!is_numeric($cat_id) ){
      return ['success'=>false,'msg'=>'function(add) not number'];
    }
    $r = $this->db->prepare('insert into product(title,price,stock,cat_id)value(:title,:price,:stock,:cat_id)');
    $r->execute([
      'title'=>$title,
      'price'=>$price,
      'stock'=>$stock,
      'cat_id'=>$cat_id,
    ]);
    return $r ?
    ['success'=>true]:
    ['success'=>false,'msg'=>'invlid insert'];
  }
  //删除
  public function remove($row){
    $id=@$row['id'];
    if(!$id){
      return ['success'=>false,'msg'=>'function(remove) not id'];
    }
    if(!($this->id_exist($id))){
      return ['success'=>false,'mag'=>'function(remove) id not exist'];
    }
    $r=$this->db->prepare('delete from product where id=:id');
    $r->execute([
      'id'=>$id,
    ]);
    return $r ?
    ['success'=>true]:
    ['success'=>false,'msg'=>'function(remove) '];

  }
  //读数据
  public function read($row=[]){
    $id = @$row['id'];
    //判断是否传入id
    if(!$id){
      //没传入，每次读十条
      $page = @$row['page'] ?:1;
      $limit = 10;
      $setOff = $limit*($page-1);
      $r=$this->db->prepare('select * from product order by id desc limit :setOff, :limit');
      $r->execute([
        'limit'=>$limit,
        'setOff'=>$setOff,
      ]);
      return ['success'=>true,'data'=>$r->fetchAll(PDO::FETCH_ASSOC)];
    }else{
      //把id条取出
      $r = $this->db->prepare('select * from product where id=:id');
      $r->execute([
        'id'=>$id,
      ]);
      return ['success'=>true,'data'=>$r->fetch(PDO::FETCH_ASSOC)];
    }
  }
  //更新
  public function update($row){
    $id = @$row['id'];
    if(!$id){
      return ['success'=>false,'mag'=>'not id'];
    }
    $stamt=$this->db->prepare('select * from product where id=:id');
    $stamt->execute([
      'id'=>$id,
    ]);
    $old = $stamt->fetch(PDO::FETCH_ASSOC);
    $merged = array_merge($old,$row);
    $r=$this->db->prepare('update product set title=:title, price=:price, cover_src=:cover_src, stock=:stock, des=:des, cat_id=:cat_id, data=:data where id = :id');
    $r->execute($merged);
    return $r ?
    ['success'=>true]:
    ['success'=>false,'msg'=>'function(update)'];
  }
  public function id_exist($id){
    $r=$this->db->prepare('select * from product where id=:id');
    $r->execute([
      'id'=>$id,
    ]);
    return (bool) $r->fetch(PDO::FETCH_ASSOC);
  }
}
?>