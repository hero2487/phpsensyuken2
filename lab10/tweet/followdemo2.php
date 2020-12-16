<!DOCTYPE html>
<html lang="en">
<head>
 <title>みんなのツイート</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
 <link rel="stylesheet" href="./css/infinity.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
 $(window).scroll(function(){
 var position = $(window).scrollTop();
 var bottom = $(document).height() - $(window).height();
​
//  一番下までスクロールしたら実行==================
 if( position == bottom ){
 var row = Number($('#row').val());
 var allcount = Number($('#all_product_count').val());
 var rowperpage = 5;
 row = row + rowperpage;
 console.log(row);
 if(row <= allcount){
 $('.ajax-load').show();
 var url = "pagination demo.php";
 $('#row').val(row);
 $.ajax({
 url: url,
 type: 'post',
 data: {row:row,rowperpage:rowperpage},
 success: function(response){
 $('.ajax-load').hide();
 $(".product:last").after(response).show().fadeIn("slow");
 }
 });
 }
 else{
 $('#remove').remove();
 $(".product:last").after('<tr id="remove"><td colspan="4" style="text-align: center;"><b>No Data Available</b></td></tr>');
 }
 }
 });
 });
 </script>
​
 
</head>
<body>
<?php
ini_set('display_errors',1);
 include('funcs.php'); 
 $row= 0;
 $rowperpage =5;
 $count_product_query = "SELECT count(*) as allcount FROM akiya_tweet_table";
 $count_product_result = mysqli_query($conn,$count_product_query);
 $count_product_fetch = mysqli_fetch_array($count_product_result);
 $all_product_count = $count_product_fetch['allcount'];
 ?>
 <div class="container">
 <h2>みんなのツイート</h2>
 <div style="overflow-x:auto;">
 <table class="table table-bordered"  width="100" height="100">
 <thead>
 <tr>
 <th>名前</th>
 <th>ツイート</th>
 <th>日時</th>
 </tr>
 </thead>
 <tbody>
 <?php
session_start();
$mid= $_SESSION["id"];
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM akiya_follow_table WHERE mid LIKE $mid");
$status = $stmt->execute();

$fi =[];
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $fi[] = $r["fid"];
    }
// print_r($fi);
// //! 最後の , を削除する※これめっちゃ重要
// $str=  rtrim($fi, ',');

// ================================================
 $query = "SELECT * FROM akiya_tweet_table ORDER BY  indate DESC LIMIT $row,$rowperpage";
 $result = mysqli_query($conn,$query);
 $view="";
 while($row = mysqli_fetch_array($result)){
  if(in_array($row['mid'], $fi)) {
    $view ="<button id='follow' class='follow' data-primary='".$row['id']."' value='フォローをやめる'>フォローをやめる</button>";
  }else{
    $view ="<button id='follow' class='follow' data-primary='".$row['id']."' value='フォローする'>フォローする</button>";
  }
    ?>
 <tr class="product" id="product_<?php echo $row['id']; ?>">
 <td><?php echo $row['name']; ?></td>
 <td><?php echo $row['tweet']; ?></td>
 <td><?php echo $row['indate']; ?></td>
 <td><?php echo $view;?></td>
 </tr>
 <?php } ?>
 </tbody>
 </table>
 <input type="hidden" id="row" value="0">
 <input type="hidden" id="all_product_count" value="<?php echo $all_product_count; ?>">
 </div>
 <div class="row ajax-load" style="display:none;">
 <!-- <div class="col-lg-12" style="text-align: center;">
 <img src="loader.gif" width"100px" height="100px"/>
</div> -->
 </div>
 </div>
</body>
</html>
