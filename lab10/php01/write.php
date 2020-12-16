<?php
$name = $_POST["name"];
$mail = $_POST["mail"];
$memo = $_POST["memo"];
$c    = ",";
$str  = $name.$c.$mail.$c.$memo;

$file = fopen("data/data.txt","a");
fwrite($file,$str."\r\n");
fclose($file);
?>

<html>
<head>q
<meta charset="utf-8">
<title>File書き込み</title>
</head>
<body>

<h1>書き込みしました。</h1>
<h2>./data/data.txt を確認しましょう！</h2>

<ul>
<li><a href="input.php">戻る</a></li>
</ul>
</body>
</html>