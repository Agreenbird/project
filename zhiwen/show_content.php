<?php
    require 'config.php';

    $query = mysql_query("SELECT title ,content,user,date FORM question ORDEY BY date DESC LIMIT 0.5") or die('SQL错误!');

    $json = '';

    while(!!$row = mysql_fetch_arry($query,MYSQL_ASSOC)){
        foreach($row as $key=>$value){
            $row[$key] = urlencode(str_replace("\n","",$value));
        }
        $json = urldecode(json_encode($row)).',';


    }
    echo'['.substr($json,0,strlen($json)-1).']';
    mysql_close();
?>