<?php
ini_set('display_errors', 1);
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];
$lpw       = password_hash($lpw, PASSWORD_DEFAULT); 

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//入力したIDが既に存在しているか見に行く
$stmt = $pdo->prepare("SELECT * FROM `akiya_user_table` WHERE lid=:lid");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
  sql_error();
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
//if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val["id"] != "" ){
//既にある場合
echo "ご入力のIDは既に使われています。";
exit();
}else{

// ============ここから先データ登録=====================

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO akiya_user_table(name,lid,lpw,kanri_flg,life_flg,indate)VALUES(:name,:lid,:lpw,:kanri_flg,:life_flg,sysdate())");

//Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  
// 実行👇
$status = $stmt->execute();

// ４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: touroku_con.php"); //リダイレクト
  exit();
}

}
?>
