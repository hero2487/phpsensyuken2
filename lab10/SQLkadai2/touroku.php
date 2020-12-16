<!-- http://localhost/lab10/SQLkadai2/touroku.php -->

<?php
//0. SESSION開始！！
session_start();

$slid= $_SESSION["lid"];
$kanri_flg = $_SESSION["kanri_flg"];

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>空き家登録</title>
  <link href="./css/reset.css" rel="stylesheet">
  <link href="./css/touroku.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <div class="sakippo">
        <img class="ilast" src="./img/akiyailast.png" alt="">
        <h1>空き家相談所</h1>
    </div>
    <ul class="list">
        <a href="./mapsentaku.php">空き家MAP</a>
        <a href="./touroku.php">空き家を登録する</a>
        <a href="./select.php">空き家一覧</a>
        <a href="./list.php">あなたの空き家</a>
        <a class="navbar-brand" href="logout.php">ログアウト</a>
        <a href="">ホーム</a>
    </ul>
</header>
<nav class="navbar navbar-default">
    <h1>登録情報ページ</h1>
  </nav>
<!-- Head[End] -->
<div id="main">
    <div id="myMap" style='visibility: hidden;'></div>
</div>

<!-- Main[Start] -->
<form method="post" action="./insert.php" enctype="multipart/form-data" >
  <div class="jumbotron" id="jumbotron">
   <fieldset>
    <legend>

        <label>建物種別：
     <select name="home_type" id="">
         <option value="戸建">戸建</option>
         <option value="集合">集合</option>
        </select>
    </label><br>
    <label>住所：<input type="text" id="jusyo" class="" value="" name="adress"></label><br>
    <label>家賃：
    <select name="rent" id="">
        <option value="１〜３万円">１〜３万円</option>    
        <option value="〜４万円">〜４万円</option>    
        <option value="〜５万円">〜５万円</option>    
        <option value="〜６万円">〜６万円</option>    
        <option value="〜７万円">〜７万円</option>    
        <option value="〜８万円">〜８万円</option>    
        <option value="〜９万円">〜９万円</option>    
        <option value="１０〜１３万円">１０〜１３万円</option>    
        <option value="１３〜１５万円">１３〜１５万円</option>    
        <option value="１５万円〜">１５万円〜</option>    
    </select></label><br>
    <label>築年数：
    <select name="Year_of_construction" id="">
        <option value="〜５年">〜５年</option>
        <option value="〜１０年">〜１０年</option>
        <option value="〜２０年">〜２０年</option>
        <option value="〜３０年">〜３０年</option>
        <option value="〜４０年">〜４０年</option>
        <option value="〜５０年">〜５０年</option>
        <option value="〜６０年">〜６０年</option>
        <option value="〜７０年">〜７０年</option>
    </select>
</label><br>

<label>写真アップロード１：
<input type="file" name="image"></label><br>
<label>写真アップロード２：
<input type="file" name="image2"></label><br>
<label>写真アップロード３：
<input type="file" name="image3"></label><br>
<label>ガス：
<select name="gas" id="">
    <option value="都市ガス">都市ガス</option>
    <option value="プロパン">プロパン</option>
</select>
</label><br>
<label>駐車：
<select name="parking" id="">
    <option value="有り">有り</option>
    <option value="無し">無し</option>
</select></label><br>
<label>駐輪：
     <select name="cycle_parking" id="">
         <option value="有り">有り</option>
         <option value="無し">無し</option>
        </select></label><br>
        <label>専有面積：
        <select name="breadth" id="">
            <option value="２０平米未満">２０平米未満</option>
            <option value="３０平米未満">３０平米未満</option>
            <option value="４０平米未満">４０平米未満</option>
            <option value="５０平米未満">５０平米未満</option>
            <option value="６０平米未満">６０平米未満</option>
            <option value="７０平米未満">７０平米未満</option>
        </select>
    </label><br>
    <label>バス・トイレ：
    <select name="bas_toilet" id="">
        <option value="バス・トイレ別">バス・トイレ別</option>
        <option value="ユニットバス">ユニットバス</option>
    </select>
    
</label><br>
<label>庭：
<select name="garden" id="">
    <option value="有り">有り</option>
    <option value="無し">無し</option>
</select>
</label><br>
<label>保証人：
<select name="No_guarantor" id="">
    <option value="必要">必要</option>
    <option value="不要">不要</option>
</select>
</label><br>
<label>ルームシェア可：
<select name="room_share" id="">
    <option value="可能">可能</option>
    <option value="不可">不可</option>
</select>
</label><br>
<label>最短居住日：　※半角数字<br><input type="text" name="can_live"></label>週間後<br>

<label>詳細：<textArea name="memo" rows="4" cols="40"></textArea></label>
        <input type="text" name="latitude" class="hidden" id="lat"> 
        <input type="text" name="longitude" class="hidden" id="lon">
        <input type="text" style="visibility:hidden;" name="lid" value="<?=$slid?>">
        <input type="text" style="visibility:hidden;" name="kanri_flg" value="<?=$kanri_flg?>">
</legend>
<button><input type="submit" id="get" name="upload" value="送信"></button>

</fieldset>
</div>
</form>
<!-- Main[End] -->


<!-- ＝＝画像保存ここまで＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ArKOjzxRYjnXj7IJq5igWzogHt_XAr0Ky_d8MV1MTUOskBRhU8Zk0u1_e2NwrGIJ' async defer></script>
<script>

    /**
     * BingMapsControllerを読み込んだらGetMap()を実行
     * @constructor
     */
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
            geocodeQuery(document.getElementById("from").value);
        });
    }


    //住所入力時に緯度経度を取得
    $("#jusyo").on("change",function(){
        geocodeQuery(document.getElementById("jusyo").value);
    });

    /**
     * 住所から緯度経度を取得
     * @param query [住所文字列]
     */
    function geocodeQuery(query) {
        if(searchManager) {
            //住所から緯度経度を検索
            searchManager.geocode({
                where: query,       //検索文字列
                callback: function (r) { //検索結果を"( r )" の変数で取得
                    //最初の検索取得結果をMAPに表示
                    if (r && r.results && r.results.length > 0) {
                        //Pushpinを立てる
                        // const pin = new Microsoft.Maps.Pushpin(r.results[0].location);
                        // map.entities.push(pin);
                        //map表示位置を再設定
                        // map.setView({ bounds: r.results[0].bestView});
                        //取得た緯度経度をh1要素にJSON文字列にして表示
                        console.log(r);
                        // document.getElementById("lat").innerText = JSON.stringify(r.results[0].location.latitude);
                        // document.getElementById("lon").innerText = JSON.stringify(r.results[0].location.longitude);
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
