<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];
$age    = $_POST["age"]; //追加されています
$id     = $_POST["id"];


//2. DB接続します
//*** function化する！  *****************
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "UPDATE gs_an_table SET name=:name,email=:email,age=:age,naiyou=:naiyou WHERE id=:id";



$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      
$stmt->bindValue(':email', $email, PDO::PARAM_STR);    
$stmt->bindValue(':age', $age, PDO::PARAM_INT);        
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);   
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}
?>
