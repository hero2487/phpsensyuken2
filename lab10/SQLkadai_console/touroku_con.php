<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>管理画面</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="./css/reset.css" rel="stylesheet">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
        <h1>管理画面</h1>
</header>
    <h1>新規登録</h1>

<!-- 登録フォーム -->
<form method="post" action="./insert_con.php">
<div class="jumbotron" id="jumbotron">
<fieldset>
<legend>
<label>氏名：
<input type="text" name="name"></label><br>
<label>ID：
<input type="text" name="lid"></label><br>
<label>PW：
<input type="text" name="lpw"></label><br>
<select name="kanri_flg" style="visibility: hidden;">
    <option value="0">管理者</option>
    <option value="1">スーパー管理者</option>
</select></label><br>
<select name="life_flg" style="visibility: hidden;">
    <option value="0">入会中</option>
    <option value="1">退会中</option>
</select></label><br>
</legend>
<button id="get" value="送信">送信</button>
<!-- <input type="submit" value="送信"> -->
</fieldset>
</div>
</form>
<!-- Main[End] -->

<script>
</script>
</body>
</html>
