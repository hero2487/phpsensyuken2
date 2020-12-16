<?php
//0. SESSION開始！！
session_start();

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
echo $ward;

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<form action="./mappage.php"  method="post">
  <input type="text" id="jusyo" name="search" 
value="<?=$ward?>">
  <input type="text" name="latitude" class="" id="lat"> 
  <input type="text" name="longitude" class="" id="lon">
</form>

<div id="main">
    <div id="myMap" style='visibility: hidden;'></div>
</div>



<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ArKOjzxRYjnXj7IJq5igWzogHt_XAr0Ky_d8MV1MTUOskBRhU8Zk0u1_e2NwrGIJ' async defer></script>
<script>

let promise = new Promise((resolve, reject) => { // #1

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
})

promise.then((msg) => { // #2
  return new Promise((resolve, reject) => {
    location.replace("./mappage.php");
  })

// setTimeout(() => { // 時間のかかる処理
// let check = $("#lat").val();
// console.log(check)
// }, 2500)


   


  </script>