
<?php
ini_set('display_errors', 1);
//0. SESSION開始！！
session_start();

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$adress = $_POST['adress'];
$home_type = $_POST['home_type'];
$rent = $_POST['rent'];
$Year_of_construction = $_POST['Year_of_construction'];
$gas = $_POST['gas'];
$parking = $_POST['parking'];
$cycle_parking = $_POST['cycle_parking'];
$breadth = $_POST['breadth'];
$bas_toilet = $_POST['bas_toilet'];
$garden = $_POST['garden'];
$No_guarantor = $_POST['No_guarantor'];
$room_share = $_POST['room_share'];
$can_live = $_POST['can_live'];
$memo = $_POST['memo'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$lid = $_POST['lid'];
$kanri_flg = $_POST['kanri_flg'];

  // イメージ１
  $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
  $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
  $file = "img/$image";

  // イメージ２
  $image2 = uniqid(mt_rand(), true);//ファイル名をユニーク化
  $image2 .= '.' . substr(strrchr($_FILES['image2']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
  $file2 = "img/$image2";
  
// イメージ３
$image3 = uniqid(mt_rand(), true);//ファイル名をユニーク化
$image3 .= '.' . substr(strrchr($_FILES['image3']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
$file3 = "img/$image3";


//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO akiya_bukken(postal_code1,postal_code2,adress,email,home_type,rent,Year_of_construction,image,image2,image3,gas,parking,cycle_parking,joutai,breadth,bas_toilet,garden,No_guarantor,can_live,room_share,memo,latitude,longitude,indate,last_update,lid,kanri_flg)VALUES(:postal_code1,:postal_code2,:adress,:email,:home_type,:rent,:Year_of_construction,:image,:image2,:image3,:gas,:parking,:cycle_parking,:joutai,:breadth,:bas_toilet,:garden,:No_guarantor,:can_live,:room_share,:memo,:latitude,:longitude,sysdate(),sysdate(),:lid,:kanri_flg)");



//Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':postal_code1', $postal_code1, PDO::PARAM_INT);  
$stmt->bindValue(':postal_code2', $postal_code2, PDO::PARAM_INT);  
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);  
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  
$stmt->bindValue(':home_type', $home_type, PDO::PARAM_STR);  
$stmt->bindValue(':rent', $rent, PDO::PARAM_STR);  
$stmt->bindValue(':Year_of_construction', $Year_of_construction, PDO::PARAM_STR);  
$stmt->bindValue(':image', $image, PDO::PARAM_STR);  
$stmt->bindValue(':image2', $image2, PDO::PARAM_STR);  
$stmt->bindValue(':image3', $image3, PDO::PARAM_STR);  
$stmt->bindValue(':gas', $gas, PDO::PARAM_STR);  
$stmt->bindValue(':parking', $parking, PDO::PARAM_STR);  
$stmt->bindValue(':cycle_parking', $cycle_parking, PDO::PARAM_STR);  
$stmt->bindValue(':joutai', $joutai, PDO::PARAM_STR);  
$stmt->bindValue(':breadth', $breadth, PDO::PARAM_STR);  
$stmt->bindValue(':bas_toilet', $bas_toilet, PDO::PARAM_STR);  
$stmt->bindValue(':garden', $garden, PDO::PARAM_STR);  
$stmt->bindValue(':No_guarantor', $No_guarantor, PDO::PARAM_STR);  
$stmt->bindValue(':can_live', $can_live, PDO::PARAM_STR);  
$stmt->bindValue(':room_share', $room_share, PDO::PARAM_STR);  
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  
$stmt->bindValue(':latitude', $latitude, PDO::PARAM_STR);  
$stmt->bindValue(':longitude', $longitude, PDO::PARAM_STR);  
$stmt->bindValue(":lid", $lid, PDO::PARAM_STR);  
$stmt->bindValue(":kanri_flg", $kanri_flg, PDO::PARAM_INT);  

// 実行👇

if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
  move_uploaded_file($_FILES['image']['tmp_name'], './img/' . $image);//imagesディレクトリにファイル保存
  if (exif_imagetype($file)) {//画像ファイルかのチェック
      $message = '画像をアップロードしました';
      // $status = $stmt->execute();
  } else {
      $message = '画像ファイルではありません';
  }
}
if (!empty($_FILES['image2']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
  move_uploaded_file($_FILES['image2']['tmp_name'], './img/' . $image2);//imagesディレクトリにファイル保存
  if (exif_imagetype($file2)) {//画像ファイルかのチェック
      $message = '画像をアップロードしました';
      // $status = $stmt->execute();
  } else {
      $message = '画像ファイルではありません';
  }
}
if (!empty($_FILES['image3']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
  move_uploaded_file($_FILES['image3']['tmp_name'], './img/' . $image3);//imagesディレクトリにファイル保存
  if (exif_imagetype($file3)) {//画像ファイルかのチェック
      $message = '画像をアップロードしました';
      // $status = $stmt->execute();
  } else {
      $message = '画像ファイルではありません';
  }
}
$status = $stmt->execute();

?>
<p><?php echo $message; ?></p>

<?php
// ４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: touroku.php"); //リダイレクト
  exit();
}
?>


