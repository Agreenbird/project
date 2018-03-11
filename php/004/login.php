<?php
session_start();
$nameErr = $passErr = '';
?>
<!DOCTYPE html>
<html lang="zh-ch">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    .error{
        color:#FF0000;
    }
    </style>
</head>
<body>
<h3 class="error">*为必填项</h3>
    <form action="welcome.php" method="post">
        <input type="text" name="username" placeholder="用户名">
        <span class="error">* <?php echo $nameErr;?></span>
        <br/><br/>
<!--显示哪里出了错误-->
        <input type="text" name="password" placeholder="密码">
        <span class="error">*<?php echo $passErr;?></span>
        <br/><br/>
        <button type='submit'>登陆</button>
    </form>    
</body>
</html>