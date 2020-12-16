<?php
ini_set('display_errors',1);
session_start();
//1. POSTデータ取得
$tweet = $_POST["tweet"];
$mid = $_SESSION["id"];
$name = $_SESSION["name"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO akiya_tweet_table(mid, tweet,name,indate )VALUES(:mid, :tweet, :name, sysdate())");
$stmt->bindValue(':mid', $mid);
$stmt->bindValue(':tweet', $tweet);
$stmt->bindValue(':name', $name);
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
  echo "false";
}else{
  echo "true";
}
?>
