<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
  <div id="status">検索フォーム</div>
  <div class="jumbotron">
   <fieldset>
    <legend>アカウント検索</legend>
     <label>名前：<input type="text" id="name"></label>
     <button id="btn">送信</button>
    </fieldset>
  </div>
  <div>
    <div class="container jumbotron">
    <p id="nishiyama"></p>
    <p id="email"></p>
    <p id="id"></p>
    </div>
</div>

<!-- Main[End] -->



<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
//登録ボタンをクリック
$("#btn").on("click",function() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('name',  $("#name").val());

    //axiosでAjax送信
    axios.post('demoselect_inquiry.php',params).then(function (response) {
        // console.log(typeof response.data);//通信OK
        if(response.data==false){
          $("#status").html("登録出来ませんでした");
        }else{
          console.log(response.data["id"])
          $("#nishiyama").html(response.data["name"]);
          $("#email").html(response.data["email"]);
          $("#id").html(response.data["id"]);
        }
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
});
</script>

</body>
</html>