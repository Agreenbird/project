<?php
session_start();


$username = $_POST['username'];
$password = $_POST['password'];

//不知加不加引号
// if($username === 'root' && $password === 'root'){
//     echo '登陆成功';
//     //要跳转到管理页面
  
//     redirect('./index.php');

// }else{
//     echo '登陆失败';
//     //跳转登陆页面

//     redirect('./login.php');
// }

if ($username === 'root') {
    if ($password === 'root') {
        $_SESSION['root'] = 'adamin';
        echo '登陆成功';
        redirect('./index.php');
    } else {
        $passErr = '密码错误';
        echo '登陆失败';
        redirect('./login.php');
    }
} else {
    $nameErr = '用户名错误';
    echo '登陆失败';
    redirect('./login.php');
}

function redirect($url)
{
    //要设置延迟跳转
    header('Location:'.$url);
}
