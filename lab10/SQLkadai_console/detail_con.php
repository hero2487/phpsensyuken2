<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM akiya_user_table WHERE id=:id");
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
  <title>編集画面</title>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update_con.php">
  <div class="jumbotron">
   <fieldset>
    <legend>管理者</legend>
     <label>名前：<input type="text" name="name" value="<?=$v["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$v["lid"]?>"></label><br>
     <label>PW：<input type="text" name="lpw" value="<?=$v["lpw"]?>"></label><br>
     <label>管理権限：<select name="kanri_flg" value="<?=$v["kanri_flg"]?>">
    <option value="0">管理者</option>
    <option value="1">スーパー管理者</option>
</select></label><br>
<label>ステータス：
<select name="life_flg" value="<?=$v["life_flg"]?>">
    <option value="0">退社</option>
    <option value="1">入社</option>
</select></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>