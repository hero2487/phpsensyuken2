<!-- http://localhost/lab10/bootstrap/index.php -->
<?php
ini_set('display_errors',1);
session_start();
$mid= $_SESSION["id"];
$name = $_SESSION["name"];
include('../tweet/funcs.php'); 

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Sample</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
  </head>
<style>
  .box1{
    background-color: antiquewhite;
  }
  .box2{
    background-color: darkcyan;
  }

</style>

  <body>
    <h1>Hello, world!</h1>

    <button id="fas" class="fass btn-floating btn-cyan" data-primary="1"><i class="fas fa-comment"></i></button>
    <button id="fas" class="fass btn-floating btn-cyan" data-primary='uncho'><i class="fas fa-comment"></i></button>
  <div class="content">
  <div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
<!-- ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
<fieldset>
<legend>ツイート文</legend>
  <textArea id="tweet" rows="4" cols="40"></textArea><br>
  <button id="btn" value="">つぶやく</button>
</fieldset>

<!-- ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
</div>
</div>
</div>

<script>
$(".fass").on("click",function(e){
  const pk = e.currentTarget.attributes[2].nodeValue;
  $("#btn").val(pk);
  $('.js-modal').fadeIn();
          return false;
})

$('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });

  $(function(){
    $('.js-modal-open').on('click',function(){
      $('.js-modal').fadeIn();
      return false;
    });
    $('.js-modal-close').on('click',function(){
      $('.js-modal').fadeOut();
      return false;
    });
  });

  $("#btn").on("click",function() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('coment',  $("#tweet").val());
    params.append('tid',  $("#btn").val());
    //axiosでAjax送信
    axios.post('../tweet/coment_insert.php',params).then(function (response) {
        console.log(typeof response.data);//通信OK
        if(response.data==true){
          $("#tweet").val("");
        }else{
          $("#status").html("登録出来ませんでした");
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