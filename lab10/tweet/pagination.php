<?php
ini_set('display_errors',1);
session_start();
$mid= $_SESSION["id"];
$row= $_POST["row"];
$rowperpage= $_POST["rowperpage"];


include("funcs.php");
$pdo = db_conn();


// 
$stmt = $pdo->prepare("SELECT * FROM akiya_follow_table WHERE mid LIKE $mid");
$status = $stmt->execute();

$fi="";
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $fi.=$r["fid"].",";
    }

//! 最後の , を削除する※これめっちゃ重要
$str=  rtrim($fi, ',');


// フォローしてる人の配列👇
//? print_r($f);

// // フォローしてるIDのつぶやきを取りにいく＆表示化

$query = "SELECT * FROM akiya_tweet_table WHERE mid in ($str) ORDER BY indate DESC LIMIT $row,$rowperpage";
$result = mysqli_query($conn,$query);


while($row = mysqli_fetch_array($result)){
  $view ="<button id='follow' class='follow' data-primary='".$row['id']."' value='フォローする'>フォローする</button>";
  ?>
 <tr class="product" id="product_<?php echo $row['id']; ?>">
 <td><?php echo $row['name']; ?></td>
 <td><?php echo $row['tweet']; ?></td>
 <td><?php echo $row['indate']; ?></td>
 <td><?php echo $view;?></td>
  </tr>
  <?php } ?>

