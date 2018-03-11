<?php
class Cat
{
    public $db;
    public function __construct($db){
        $this->db = $db;
    }
    //添加数据的方法
    public function add($row){
        //取出各项数据
        $title = @$row['title'];
        //对取出的数据进行判断
        if(!$title){
            return ['success'=>false,'msg'=>'title不存在'];
        }
        if($this->title_exist($title)){
            return ['success'=>false,'msg'=>'exist:title'];
        }

        $r=$this->db
            ->prepare('insert into cat(title)value(:title)')
            ->execute(['title'=>$title]);
        return $r ?
            ['success'=>true]:
            ['success'=>false,'msg'=>'插入失败'];
      
    }
    //删除数据
    public function remove($row){
        $id = @$row['id'];
        if(!$id){
            return ['success'=>false,'msg'=>'没id'];
        }
        if(!($this->find($id))){
            return ['success'=>false,'msg'=>'not find id'];
        }
        $r = $this->db->prepare('delete from cat  where id = :id')
            ->execute(['id'=>$id]);
        return $r ?
        ['success'=>true]:
        ['success'=>false,'msg'=>'invalid remove'];
    }
    //改类别
    public function update($row){
        $id = @$row['id'];
        $title=@$row['title'];
        //有没有值
        if(!$title || !$id){
            return ['success'=>true,'msg'=>'invlid update'];
        }
        //有没有这个id
        if(!($this->find($id))){
            return ['success'=>false,'msg'=>'id无效'];
        }
        //改的title重不重复
        if($this->title_exist($title)){
            return ['success'=>false,'msg'=>'title无效'];
        }
        $r=$this->db->prepare('update cat set title= :title where id= :id');
        $r->execute([
            'title'=>$title,
            'id'=>$id,
        ]);
        return $r ?
        ['success'=>true]:
        ['success'=>false,'msg'=>'invalid update'];
    }
    //查
    public function read(){
        $stamt =  $this->db->prepare('select * from cat');
        $stamt ->execute();
        $old = $stamt->fetchAll(PDO::FETCH_ASSOC);
        return $old;
    }
    //查看title是否重复
    public function title_exist($title){
        $r=$this->db->prepare('select * from cat  where title = :title');
            $r->execute(['title'=>$title]);
            //判断布尔值
            return (bool) $r->fetch(PDO::FETCH_ASSOC);
    }
    //找到id所在的数据
    public function find($id){
        $r = $this->db
            ->prepare('select * from cat where id = :id');
            $r->execute(['id'=>$id]);
        return $r->fetch(PDO::FETCH_ASSOC);
    }
}
?>