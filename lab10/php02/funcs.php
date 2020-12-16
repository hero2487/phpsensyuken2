<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function db_conn(){
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//さくらのアドレスユーザー名、パスワード
        // $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=mysql57.blackwalrus3.sakura.ne.jp','blackwalrus3','marilyn666');//さくらのアドレスユーザー名、パスワード
        return $pdo;
      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }
}


