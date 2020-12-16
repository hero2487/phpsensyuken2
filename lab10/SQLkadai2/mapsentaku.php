<?php
//0. SESSION開始！！
session_start();


//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>空き家探索</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="./css/reset.css" rel="stylesheet">
  <link href="./css/mapsentaku.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <style>div{padding: 10px;font-size:16px;}</style>

<header>
  <div class="hidari">
    <img src="./img/akiyailast.png" alt="">
    <h1>空き家探索</h1>
  </div>
</header>
<body>
<main>
<div id="main">
    <div id="myMap" style='visibility: hidden;'></div>
</div>

<form action="./mappage.php"  method="post">
  <input type="text" id="jusyo" name="search">
    <input type="text" name="latitude" style="visibility:hidden;" class="" id="lat"> 
  <input type="text" name="longitude" style="visibility:hidden;" class="" id="lon">
  <input type="submit" value="検索">
</form>
<!-- <button type="button" onclick="location.href='./mappage.php'">移動</button> -->
<div class="mainImage">
    <img src="./img/23ku1.jpg" class="ku" alt="">
    <form method="post" action="./mappage.php" enctype="multipart/form-data">
    <button class="sibuya" name="sibuya" id="sibuya">渋谷区</button>
    <button type="submit" class="minato" name="minato">港区</button>
    <button type="submit" class="tiyoda" name="tiyoda">千代田区</button>
    <button type="submit" class="oota" name="oota">大田区</button>
    <button type="submit" class="nakano"" name="oota">中野区</button>
    <button type="submit" class="kita" name="oota">北区</button>
    <button type="submit" class="adati" name="oota">足立区</button>
    <button type="submit" class="bunkyou" name="oota">文京区</button>
    <button type="submit" class="setagaya" name="oota">世田谷区</button>
    <button type="submit" class="meguro" name="oota">目黒区</button>
    <button type="submit" class="etou" name="oota">江東区</button>
    <button type="submit" class="edogawa" name="oota">江戸川区</button>
    <button type="submit" class="sumida" name="oota">墨田区</button>
    <button type="submit" class="katusika" name="oota">葛飾区</button>
    <button type="submit" class="itabashi" name="oota">板橋区</button>
    <button type="submit" class="nerima" name="oota">練馬区</button>
    <button type="submit" class="suginami" name="oota">杉並区</button>
</form>
</div>
</main>


<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ArKOjzxRYjnXj7IJq5igWzogHt_XAr0Ky_d8MV1MTUOskBRhU8Zk0u1_e2NwrGIJ' async defer></script>
<script>
    let map;             //MapObject用
    let searchManager;   //SearchObject用
    function GetMap() {
        //Map生成
        map = new Microsoft.Maps.Map('#myMap', {
            zoom: 15,
            mapTypeId: Microsoft.Maps.MapTypeId.aerial
        });
        //検索モジュール指定
        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
            //searchManagerインスタンス化（Geocode,ReverseGeocodeが使用可能になる）
            searchManager = new Microsoft.Maps.Search.SearchManager(map);
            //Geocode：住所から検索
            geocodeQuery(document.getElementById("jusyo").value);
        });
    }
    
    $("#jusyo").on("change",function(){
        geocodeQuery(document.getElementById("jusyo").value);
    });

    //住所入力時に緯度経度を取得
    function geocodeQuery(query) {
        if(searchManager) {
            //住所から緯度経度を検索
            searchManager.geocode({
                where: query,       //検索文字列
                callback: function (r) { //検索結果を"( r )" の変数で取得
                    //最初の検索取得結果をMAPに表示
                    if (r && r.results && r.results.length > 0) {
                        console.log(r);
                        $("#lat").val(JSON.stringify(r.results[0].location.latitude));
                        $("#lon").val(JSON.stringify(r.results[0].location.longitude));
                    }
                }
            });
        }
    }


</script>
</body>
</html>