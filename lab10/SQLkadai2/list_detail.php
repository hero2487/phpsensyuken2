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
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/list.css" rel="stylesheet">
  <title>空き家情報編集</title>
  <style>div{padding: 10px;font-size:16px;}</style>
  <!-- <link rel="stylesheet" href="./css/reset.css"> -->
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">空き家一覧に戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<div class="jumbotron" id="jumbotron">
  <div class="akiyaImage">
    <img  src='img/<?=$v["image"]?>'>
    <img  src='img/<?=$v["image2"]?>'>
    <img  src='img/<?=$v["image3"]?>'>
  </div>
    
<table>
  <tr>
    <td>建物タイプ</td>
    <td><?=$v["home_type"]?></td>
  </tr>
  <tr>
    <td>住所</td>
    <td><?=$v["adress"]?></td>
  </tr>
  <tr>
    <td>家賃</td>
    <td><?=$v["rent"]?></td>
  </tr>
  <tr>
    <td>築年数</td>
    <td><?=$v["Year_of_construction"]?></td>
  </tr>
  <tr>
    <td>駐車場</td>
    <td><?=$v["parking"]?></td>
  </tr>
  <tr>
    <td>駐輪場</td>
    <td><?=$v["cycle_parkingress"]?></td>
  </tr>
  <tr>
    <td>専有面積</td>
    <td><?=$v["breadth"]?></td>
  </tr>
  <tr>
    <td>バス・トイレ</td>
    <td><?=$v["bas_toilet"]?></td>
  </tr>
  <tr>
    <td>ルームシェア</td>
    <td><?=$v["room_share"]?></td>
  </tr>
  <tr>
    <td>保証人必要有無</td>
    <td><?=$v["No_guarantor"]?></td>
  </tr>
  <tr>
    <td>最短明渡し日</td>
    <td><?=$v["can_live"]?></td>
  </tr>
</table>
  
<!-- Main[End] -->


</body>
</html>