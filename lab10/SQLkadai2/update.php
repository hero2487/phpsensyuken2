<?php
ini_set('display_errors', 1);
//1. POSTデータ取得
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
$id = $_POST["id"];

$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
$image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
$file = "img/$image";


//2. DB接続します
//*** function化する！  *****************
include("funcs.php");
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE akiya_bukken SET home_type=:home_type,adress=:adress,rent=:rent,Year_of_construction=:Year_of_construction,image=:image,gas=:gas,parking=:parking,cycle_parking=:cycle_parking,breadth=:breadth,bas_toilet=:bas_toilet,garden=:garden,No_guarantor=:No_guarantor,can_live=:can_live,room_share=:room_share,memo=:memo, last_update=sysdate()  WHERE id=:id";

// ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

$stmt = $pdo->prepare($sql);  
$stmt->bindValue(':home_type', $home_type, PDO::PARAM_STR);  
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);  
$stmt->bindValue(':rent', $rent, PDO::PARAM_STR);  
$stmt->bindValue(':Year_of_construction', $Year_of_construction, PDO::PARAM_STR);  
$stmt->bindValue(':image', $image, PDO::PARAM_STR);  
$stmt->bindValue(':gas', $gas, PDO::PARAM_STR);  
$stmt->bindValue(':parking', $parking, PDO::PARAM_STR);  
$stmt->bindValue(':cycle_parking', $cycle_parking, PDO::PARAM_STR); 
$stmt->bindValue(':breadth', $breadth, PDO::PARAM_STR);  
$stmt->bindValue(':bas_toilet', $bas_toilet, PDO::PARAM_STR);  
$stmt->bindValue(':garden', $garden, PDO::PARAM_STR);  
$stmt->bindValue(':No_guarantor', $No_guarantor, PDO::PARAM_STR);  
$stmt->bindValue(':room_share', $room_share, PDO::PARAM_STR);  
$stmt->bindValue(':can_live', $can_live, PDO::PARAM_STR);  
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  
$stmt->bindValue(':id', $id, PDO::PARAM_INT);   
// 実行👇

if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
    move_uploaded_file($_FILES['image']['tmp_name'], './img/' . $image);//imagesディレクトリにファイル保存
    if (exif_imagetype($file)) {//画像ファイルかのチェック
        $message = '画像をアップロードしました';
        $status = $stmt->execute();
    } else {
        $message = '画像ファイルではありません';
    }
  }
  ?>
  <p><?php echo $message; ?></p>
  <?php
//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}
?>
