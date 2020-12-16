<?php
ini_set('display_errors',1);
include("funcs.php");
session_start();
$row= $_POST["row"];

$pdo = db_conn();
// $stmt = $pdo->prepare("SELECT * FROM akiya_tweet_table ORDER BY  indate ASC  LIMIT $row,$rowperpage");
$stmt = $pdo->prepare("SELECT * FROM akiya_tweet_table ORDER BY indate DESC LIMIT $row,5");
$status = $stmt->execute();

if($status == false) {
  sql_error($stmt);
}else{
$idArray=[];
$tweetArray=[];
$nameArray=[];
$indateArray=[];
while( $v = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $idArray[]= $v["id"];
  $tweetArray[]= $v["tweet"];
  $nameArray[]= $v["name"];
  $indateArray[]= $v["indate"];
}
}
header('Content-Type: application/json');
echo json_encode([
  "id" => $idArray,
  "tweet" =>$tweetArray,
  "name" =>$nameArray,
  "indateArray" =>$indateArray,
]);

?>