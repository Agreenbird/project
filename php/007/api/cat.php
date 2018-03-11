<?php
class Cat
{
    public $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function add($row){
        $id=@$row['id'];
        //判断
       $r= $this->db->prepare('insert into cat(title)value(:title)')
           ->execute(['title'=>$row['title']]);
    
        return $r ?
        ['success'=>true]:
        ['success'=>false,'msg'=>'add 错误'];
    }
    public function remove($row){
        $id = @$row['id'];
        //判断id
        $r=$this->db->prepare('delete from cat where id = :id')
             ->execute(['id'=>$id]);
        return $r ?
        ['success'=>true]:
        ['success'=>false,'msg'=>'remove 错误'];
    }
    public function update($row){
        $id=@$row['id'];
        //判断
        $stamt=$this->db->prepare('select * from cat where id=:id')
            ->execute(['id'=>$id]);
        $old= $stamt -> fetch(PDO::FETCH_ASSOC);
        
        if(!$old){
            return ['success'=>false,'msg'=>'没查到'];
        }
        $merge = array_merge($row,$old);
        $this->db->prepare('update cat set title=:title,where id = :id')
             ->execute($merge);
        
    }
    public function read($row=[]){
        $id=@$row['id'];
       
        if(!$id){
            $page = @$_GET['page'] ? :1;
            $limit= 10;
            $setOff = $limit($page-1);
            $r=$this->db->perpare('select * from cat limit :$setOff,:$limit')
                ->execute([
                    'limit'=>$limit,
                    'setOff'=>$setOff,
                ]);
            return $r->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $r=$this->db->perpare('select * from cat where id=:id')
                ->execute(['id'=>$id]);
          return $r->fetchAll(PDO::FETCH_ASSOC);
            
            
        }
    }
}

?>