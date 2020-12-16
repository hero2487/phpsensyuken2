<?php
session_start();
//1. POSTデータ取得
$fid = $_POST["fid"];
$mid = $_SESSION["id"];

include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM akiya_follow_table WHERE fid LIKE $fid");
$stmt->bindValue(":fid", $fid, PDO::PARAM_INT); 
$status = $stmt->execute();

//３．データ表示
if($status==false){
  echo "false";
}else{
  echo "true";
}
?>
