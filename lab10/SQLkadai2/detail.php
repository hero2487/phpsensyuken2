<!-- http://localhost/lab10/SQLkadai2/detail.php -->
<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM akiya_bukken WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT); 
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  $v =$stmt->fetch();
  //$v["id"] $v["name]などの一行を取れる
}
?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>空き家情報編集</title>
  <style>div{padding: 10px;font-size:16px;}</style>
  <link rel="stylesheet" href="./css/reset.css">
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">空き家一覧に戻る</a></div>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php" enctype="multipart/form-data">

<div class="jumbotron" id="jumbotron">
   <fieldset>
    <legend>
        <label>建物種別：
     <select name="home_type" id="" value="<?=$v["home_type"]?>">>
         <option value="戸建">戸建</option>
         <option value="集合">集合</option>
        </select>
    </label><br>
    <label>住所：<input type="text" id="jusyo" class="hidden" value="<?=$v["adress"]?>" name="adress"></label><br>
    <label>家賃：
    <select name="rent" id="" value="<?=$v["rent"]?>">
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
    <select name="Year_of_construction" id="" value="<?=$v["Year_of_construction"]?>">
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

<label>写真アップロード：
<input type="file" name="image"></label><br>
<label>ガス：
<select name="gas" id="" value="<?=$v["gas"]?>">
    <option value="都市ガス">都市ガス</option>
    <option value="プロパン">プロパン</option>
</select>
</label><br>
<label>駐車：
<select name="parking" id="" value="<?=$v["parking"]?>">
    <option value="有り">有り</option>
    <option value="無し">無し</option>
</select></label><br>
<label>駐輪：
     <select name="cycle_parking" id="" value="<?=$v["cycle_parking"]?>">
         <option value="有り">有り</option>
         <option value="無し">無し</option>
        </select></label><br>
        <label>専有面積：
        <select name="breadth" id="" value="<?=$v["breadth"]?>">
            <option value="２０平米未満">２０平米未満</option>
            <option value="３０平米未満">３０平米未満</option>
            <option value="４０平米未満">４０平米未満</option>
            <option value="５０平米未満">５０平米未満</option>
            <option value="６０平米未満">６０平米未満</option>
            <option value="７０平米未満">７０平米未満</option>
        </select>
    </label><br>
    <label>バス・トイレ：
    <select name="bas_toilet" id="" value="<?=$v["bas_toilet"]?>">
        <option value="バス・トイレ別">バス・トイレ別</option>
        <option value="ユニットバス">ユニットバス</option>
    </select>
    
</label><br>
<label>庭：
<select name="garden" id="" value="<?=$v["garden"]?>">
    <option value="有り">有り</option>
    <option value="無し">無し</option>
</select>
</label><br>
<label>保証人：
<select name="No_guarantor" id="" value="<?=$v["No_guarantor"]?>">
    <option value="必要">必要</option>
    <option value="不要">不要</option>
</select>
</label><br>
<label>ルームシェア可：
<select name="room_share" id="" value="<?=$v["room_share"]?>">
    <option value="可能">可能</option>
    <option value="不可">不可</option>
</select>
</label><br>
<label>最短居住日：　※半角数字<br><input type="text" name="can_live" value="<?=$v["can_live"]?>"></label>週間後<br>
<label>詳細：<br><textArea name="memo" rows="4" cols="40"></textArea></label><br>

<input type="hidden" name="id" value="<?=$id?>">
</legend>
<button id="get" name="upload" value="送信">送信</button>
<!-- <input type="submit" value="送信"> -->
</fieldset>
</div>
</form>




<!-- Main[End] -->


</body>
</html>