<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];
$id = $_POST["id"];

//2. DB接続します
//*** function化する！  *****************
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE akiya_user_table SET name=:name,lid=:lid,lpw=:lpw,kanri_flg=:kanri_flg,life_flg=:life_flg WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);    
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);        
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);   
$stmt->bindValue(':id', $id, PDO::PARAM_INT);   
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select_con.php");
}
?>
