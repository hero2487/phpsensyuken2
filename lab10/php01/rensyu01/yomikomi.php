<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
$file="./toukei.csv";
$fp = fopen($file,"r");
// while(!feof($fp)){
  $toukei = fgets($fp);
  echo $toukei.'<br>';
// }
  fclose($file);
?>
</body>
</html>