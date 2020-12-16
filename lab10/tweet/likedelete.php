<?php
session_start();
//1. POSTデータ取得
$id = $_POST["id"];
$mid = $_SESSION["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE `akiya_tweet_table` SET tweetNumber =  tweetNumber-1 WHERE id LIKE $id;");
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
  echo "false";
}else{
  echo "true";
}
?>
