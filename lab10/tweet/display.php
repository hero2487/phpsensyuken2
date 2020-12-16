<!-- http://localhost/lab10/tweet/display.php -->

<?php
//SESSION開始！！
session_start();
$mid= $_SESSION["id"];

//関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//TODOデータ登録SQL作成
$pdo = db_conn();

// 
  $stmt = $pdo->prepare("SELECT * FROM akiya_follow_table WHERE mid LIKE $mid");
  $status = $stmt->execute();
  
    while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
      $f.=$r["fid"].",";
      }

//! 最後の , を削除する※これめっちゃ重要
$str=  rtrim($f, ',');
// フォローしてる人の配列👇
//? print_r($f);

// // フォローしてるIDのつぶやきを取りにいく＆表示化
$stmt = $pdo->prepare("SELECT * FROM akiya_tweet_table ORDER BY indate DESC;");
$status = $stmt->execute();



$view="";
if($status==false) {
  sql_error($stmt);
}else{
while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
  $view .= "<p>";
  $view.= $r["name"];
  $view .= "</p>";
  $view .= "<p class=".'tweet'.">";
  $view.= $r["tweet"];
  $view .= "</p>";
  $view .="<button id='follow' class='follow' data-primary='".$r['id']."' value='フォローする'>フォローする</button>";
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>みんなのつぶやき</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/display.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">みんなのつぶやき</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<main>
<div><?=$view?></div>
</main>

<!-- Main[End] -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
// let position = $(window).scrollTop();
// let doc =$(document).height()
// let win =$(window).height();


// console.log(position);
// console.log(doc);
// console.log(win);




</script>

</body>
</html>