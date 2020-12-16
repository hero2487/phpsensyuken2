<!-- http://localhost/lab10/follow/demofollow.php -->
<?php
session_start();
$mid = $_SESSION["id"];

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM akiya_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= $r["id"];
    $view .= "</p>";
    // =========削除=============
    $view .= " ";
    $view .="<button id='follow' class='follow' data-primary='".$r['id']."' value='フォローする'>フォローする</button>";
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
      <a class="navbar-brand" href="index.php">管理者一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->
<!-- Main[Start] -->

<div id="status"></div>
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
$(function(){
    $(".follow").each(function(e,v){
      $(v).click(function(e){
      const pk = e.target.getAttribute('data-primary')
        if($(v).val() == "フォローする"){
          follow(pk);
          $(v).html("フォローをやめる")
          $(v).val("フォローをやめる")
        }else{
          followdelete(pk)
          $(v).html("フォローする")
          $(v).val("フォローする")
        }
      });
    });
});


// 登録ボタンをクリック
function follow(pk){
  //axiosでAjax送信
  //Ajax（非同期通信）
  const params = new URLSearchParams();
  params.append('fid', pk);
    //axiosでAjax送信
    axios.post('followInsert.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

function followdelete(pk){
  //axiosでAjax送信
  //Ajax（非同期通信）
  const params = new URLSearchParams();
  params.append('fid', pk);
    //axiosでAjax送信
    axios.post('followdelete.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

// 登録ボタンをクリック
// $(".follow").on("click",function(e) {
//   console.log(e)
//   const pk = e.target.getAttribute('data-primary')
//     //axiosでAjax送信
//     //Ajax（非同期通信）
//     const params = new URLSearchParams();
//     params.append('fid', pk);
//     //axiosでAjax送信
//     axios.post('followInsert.php',params).then(function (response) {
//         // console.log(typeof response.data);//通信OK
//         console.log(typeof response.data);//通信OK
//         if(response.data==true){
//           $("#status").html("登録完了しました");
//         }else{
//           $("#status").html("登録出来ませんでした");
//         }
//     }).catch(function (error) {
//         console.log(error);//通信Error
//     }).then(function () {
//         console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
//     });
// });
</script>

</body>
</html>