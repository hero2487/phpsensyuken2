<?php
ini_set('display_errors',1);
include("funcs.php");
session_start();
$mid= $_SESSION["id"];
$row= $_POST["row"];
$rowperpage= $_POST["rowperpage"];

$pdo = db_conn();
// $stmt = $pdo->prepare("SELECT * FROM akiya_tweet_table ORDER BY  indate ASC  LIMIT $row,$rowperpage");
$stmt = $pdo->prepare("SELECT * FROM akiya_tweet_table ORDER BY  indate DESC LIMIT $row,$rowperpage");
$stmt->bindValue(':mid', $mid);
$status = $stmt->execute();

if($status == false) {
  sql_error($stmt);
}else{
$idArray=[];
$midArray=[];
$tweetArray=[];
$nameArray=[];
$indateArray=[];
$tweetNumberArray=[];
while( $v = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $idArray[]= $v["id"];
  $midArray[]= $v["mid"];
  $tweetArray[]= $v["tweet"];
  $nameArray[]= $v["name"];
  $indateArray[]= $v["indate"];
  $tweetNumberArray[]= $v["tweetNumber"];
}
}
header('Content-Type: application/json');
echo json_encode([
  "id" => $idArray,
  "mid" => $midArray,
  "tweet" =>$tweetArray,
  "name" =>$nameArray,
  "indateArray" =>$indateArray,
  "tweetNumberArray" =>$tweetNumberArray
]);

?>