<?php
//1. POSTデータ取得
$name   = $_POST["name"];

//2. DB接続します(エラー処理追加)
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE name LIKE '%$name%'");
$stmt->bindValue(':name', $name);
$status = $stmt->execute();

$v = $stmt->fetch();

//４．データ登録処理後
if($status==false){
  echo "false";
}else{
  echo(json_encode($v));
}
?>
