<html>
<head>
<meta charset="utf-8">
<title>POST練習</title>
</head>
<body>
<form action="./kakikomi.php" method="post">
	性別: <select name="sex" id="">
    <option value="man">男性</option>
    <option value="female">女性</option>
  </select>
	年代: <select name="gene" id="">
    <option value="10">10代</option>
    <option value="20">20代</option>
    <option value="30">30代</option>
    <option value="40">40代</option>
  </select>
	カテゴリ: <select name="category" id="">
    <option value="居酒屋">居酒屋</option>
    <option value="ラーメン">ラーメン</option>
    <option value="カフェ">カフェ</option>
    <option value="イタリアン">イタリアン</option>
  </select>
  評価: <select name="hyouka" id="">
  <option value="like">1</option>
  <option value="bad">2</option>
  </select>
	URL: <input type="text" name="url">
	<input type="submit" value="送信">
</form>

<ul>
<li><a href="index.php">index.php</a></li>
</ul>
</body>
</html>