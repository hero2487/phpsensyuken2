<!-- http://localhost/lab10/SQLkadai2/mappage.php -->

<?php
//0. SESSION開始！！
session_start();

$mapLat =$_POST["latitude"];
$mapLon =$_POST["longitude"];

$ward = $_POST["search"]; 
if(isset($_POST['sibuya'])) {
  echo $_POST['sibuya'];
  $ward = "渋谷";
} else if(isset($_POST['nakano'])) {
  $ward = "中野";
} else if(isset($_POST['minato'])) {
  $ward = "港区";
}else if(isset($_POST['suginami'])) {
  $ward = "杉並";
}else if(isset($_POST['oota'])) {
  $ward = "大田";
}else if(isset($_POST['tiyoda'])) {
  $ward = "千代田";
}

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM `akiya_bukken` WHERE adress LIKE '%$ward%';");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  $latArray = [];
  $lonArray = [];
  $home_typeArray = [];
  $rentArray = [];
  $Year_of_constructionArray = [];
  $imageArray = [];
  $imageArray = [];
  $gasArray = [];
  $parkingArray = [];
  $breadthArray = [];
  $bas_toiletArray = [];
  $gardenArray = [];
  $can_liveArray = [];
  $memoArray = [];
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
     $latArray[] = $res["latitude"];
     $lonArray[] = $res["longitude"];
     $home_typeArray[] = $res["home_type"];
     $rentArray[] = $res["rent"];
     $Year_of_constructionArray[] = $res["Year_of_construction"];
     $imageArray[] = $res["image"];
     $gasArray[] = $res["gas"];
     $parkingArray[] = $res["parking"];
     $breadthArray[] = $res["breadth"];
     $bas_toiletArray[] = $res["bas_toilet"];
     $gardenArray[] = $res["garden"];
     $can_liveArray[] = $res["can_live"];
     $memoArray[] = $res["memo"];
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<title>空き家分布マップ</title>
<link rel="stylesheet" href="">
<link href="./css/mappage.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <h1>空き家分布マップ</h1>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<h1></h1>
<div class="map">
  <div id="myMap" style='width:80%;height:700px;'></div>
</div>
<!-- モーダル -->
<div class="content">
  <div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
  <img style="max-width: 80%;  max-height: 360px;" id="akiyagazou" class="akiyagazou" src="./img/akiyailast.png" alt="">
  <table border="1" class="info">
      <tr>
        <td>家賃</td>
        <td id="yatin"></td>
    </tr><br>
    <tr>
      <td>建物タイプ</td>
      <td id="taipu"></td>
    </tr>
    <tr>
      <td>ガス</td>
      <td id="gastype"></td>
    </tr>
    <tr>
      <td>駐車場</td>
      <td id="tyusyajou"></td>
    </tr>
    <tr>
      <td>バス・トイレ</td>
      <td id="ofuro"></td>
    </tr>
    <tr>
      <td>築年数</td>
      <td id="tikunen"></td>
    </tr>
    <tr>
      <td>専有面積</td>
      <td id="menseki"></td>
    </tr>
    <tr>
      <td>庭</td>
      <td id="niwa"></td>
    </tr>
    <tr>
      <td>明渡し最短日</td>
      <td id="kanou"></td>
    </tr>
    <tr>
      <td></td>
      <td id=""></td>
    </tr>
</table>
</div>
</div>
</div>

<!-- Main[End] -->

<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ArKOjzxRYjnXj7IJq5igWzogHt_XAr0Ky_d8MV1MTUOskBRhU8Zk0u1_e2NwrGIJ' async defer></script>
<script src="js/BmapQuery.js"></script>
<script>

let lat = <?php echo json_encode($latArray);?>;
console.log(lat)
let lon = <?php echo json_encode($lonArray);?>;
let home_type = <?php echo json_encode($home_typeArray);?>;
let rent = <?php echo json_encode($rentArray);?>;
let Year_of_construction = <?php echo json_encode($Year_of_constructionArray);?>;
let image = <?php echo json_encode($imageArray);?>;
let gas = <?php echo json_encode($gasArray);?>;
let parking = <?php echo json_encode($parkingArray);?>;
let breadth = <?php echo json_encode($breadthArray);?>;
let bas_toilet = <?php echo json_encode($bas_toiletArray);?>;
let garden = <?php echo json_encode($gardenArray);?>;
let can_live = <?php echo json_encode($can_liveArray);?>;
let memo = <?php echo json_encode($memoArray);?>;
let mapLat = <?php echo json_encode($mapLat);?>;
let mapLon = <?php echo json_encode($mapLon);?>;

let num =0;
function GetMap(){
    const map = new Bmap("#myMap");
    map.startMap(35.661808013916016, 139.70407104492188, "load", 17);
    // map.startMap(35.661808013916016, 139.70407104492188, "load", 12);
    //----------------------------------------------------
    //3. Add Pushpin-Icon
    //----------------------------------------------------
    while(num <= lat["length"]){
      //取ってきた緯度・経度をすべてピンで表示する
      let pin = map.pinText(lat[num], lon[num], home_type[num],rent[num]);
      num++
      //ピンをクリックしたときに、情報を入れ替える。-10、というのは、BingMap上のピンIDが、なぜか10から開始されるから。
      //一つ目のピン（たとえば、rent[0]）のクリックした時の動きを指定したい）→rent[pin.id-10]で、rent[0]と同義に出来る。
      // 多分もっといいやり方あります笑
      map.onPin(pin, "click", function(){
        $("#yatin").html(rent[pin.id - 10]);    
        $("#taipu").html(home_type[pin.id - 10]);    
        $("#kanou").html(can_live[pin.id - 10]+"週間後");    
        $("#tikunen").html(Year_of_construction[pin.id - 10]);    
        $("#gastype").html(gas[pin.id - 10]);    
        $("#niwa").html(garden[pin.id - 10]);    
        $("#ofuro").html(bas_toilet[pin.id - 10]);    
        $("#menseki").html(breadth[pin.id - 10]);    
        $("#tyusyajou").html(parking[pin.id - 10]);    
        $("#akiyagazou").attr("src","./img/"+image[pin.id - 10]);    
        $('.js-modal').fadeIn();
        return false;
      });
    }
}

$('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });

// モーダルウィンドウ
$(function(){
    $('.js-modal-open').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });
});
</script>
</body>
</html>

