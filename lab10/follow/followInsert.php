<?php
session_start();
//1. POSTデータ取得
$fid = $_POST["fid"];
$mid = $_SESSION["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO akiya_follow_table(mid, fid,indate )VALUES($mid, $fid, sysdate())");
$stmt->bindValue(':mid', $mid);
$stmt->bindValue(':fid', $fid);
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
  echo "false";
}else{
  echo "true";
}
?>
