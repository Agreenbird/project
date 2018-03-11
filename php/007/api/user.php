<?php
class User
{
    public $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function signup($row){
        $username = @$row['username'];
        $password = @$row['password'];
        $permission = @$row['permission'];
        //对注册信息判断

        $r=$this->db->prepare('insert into user(username,password,permission)value(:username,:password,:permission')
            ->execute([
                'username'=>$username,
                'password'=>$password,
                'permission'=>$permission,
            ]);
        //返回信息
        return $r ?
        ['success'=>true]:
        ['success'=>false,'msg'=>'没注册成功'];

    }
    public function login($row){
        $username = @$row['username'];
        $password = @$row['password'];
        //等级不用用户自己输入
        // $permission = @$row['permission'];

        $stamt = $this->db->prepare('select * from user where username = :username')
                 ->execute(['username'=>$username]);
        if(!$stamt){
            //报错用户名不存在
        }
        $r = $statement->fetch(PDO::FETCH_ASSOC);
        if($r['password']===$password ){
            //报错密码有问题
        }
        //返回信息

    }
}
?>