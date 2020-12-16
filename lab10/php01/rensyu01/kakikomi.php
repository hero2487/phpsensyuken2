<?php
$sex    = $_POST["sex"];
$gene   = $_POST["gene"];
$category   = $_POST["category"];
$hyouka    = $_POST["hyouka"];
$url    = $_POST["url"];
$c      = ",";
$str    = $sex.$c.$gene.$c.$category.$c.$hyouka.$c.$url;

$file = fopen("./toukei.csv","a");
fwrite($file,$str."\r\n");
fclose($file);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  はいってるぜ
  <a href="rensyu01.php">戻る</a>
</body>
</html>