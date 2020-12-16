<?php
//Ymd His
$ymdhis = date("Y年ｍ月ｄ日 Hじi🐶s😻");
echo $ymdhis;
$s = date("s");
if($s >= 30){
  echo '<p style="color:red">赤</p>';
}else{
  echo '<p style="color:black">黒</p>';
}

?>