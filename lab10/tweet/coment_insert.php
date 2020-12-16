<?php
ini_set('display_errors',1);
session_start();
//1. POSTデータ取得
$tid = $_POST["tid"];
$mid= $_SESSION["id"];
$coment = $_POST["coment"];
$comentUser = $_SESSION["name"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO akiya_coment_table(tid, mid,coment,comentUser,indate )VALUES(:tid, :mid, :coment, :comentUser, sysdate())");
$stmt->bindValue(':tid', $tid);
$stmt->bindValue(':mid', $mid);
$stmt->bindValue(':coment', $coment);
$stmt->bindValue(':comentUser', $comentUser);
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
  echo "false";
}else{
  echo "true";
}
?>
