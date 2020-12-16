<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$ward = $_POST["search"]; 

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM akiya_bukken WHERE adress LIKE '%$ward%';");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $imgUrl = $r["image"];
    $view .= "<p>";
    $view .= "<a href='list_detail.php?id=".$r['id']."'>";
    $view .= $r["id"]."|".$r["adress"]."|".$r["breadth"].$r["gas"].$r["rent"].$r["parking"];
    $view .= "</a>";
    $view .= "</p><br>";
    // 画像
    $view .="<img width='100' height='100' src='img/$imgUrl'>";

    }
    $view .= "</p>";
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="./css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理者一覧</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../tweet/followzumi.php">空き家ツイート</a>
      <a class="navbar-brand" href="select.php">空き家一覧</a>
      <a class="navbar-brand" href="touroku.php">空き家登録</a>
      <a class="navbar-brand" href="mapsentaku.php">空き家を探す</a>
      <a class="navbar-brand" href="list.php">あなたの空き家</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->
<!-- Main[Start] -->
<form action="./select.php"  method="post">
  <input type="text" name="search">
  <input type="submit" value="検索">
</form>

<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>