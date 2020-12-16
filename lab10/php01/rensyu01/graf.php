<?php
$filenamae = 'demo.csv';

$izakaya_20 =0;
$cafe_20 =0;
$italy_20 =0;
$demo = fopen("demo.csv");
while(($lines = fgets($demo))){
  for($i=0; $i < count($lines); $i++){
    $tempArr = explode(",",$templines[i]);
    print_r($tempArr);
    print_r($tempArr);
    if ($tempArr[0] == "male" && $tempArr[1] == 20 && $tempArr[2] == "居酒屋"){
      $izakaya_20++;
      echo $izakaya_20;
    }elseif($tempArr[0] == "male" && $tempArr[1] == 20 && $tempArr[2] == "カフェ") {
      $cafe_20++;
      echo $cafe_20;
    }elseif($tempArr[0] == "male" && $tempArr[1] == 20 && $tempArr[2] == "イタリアン"){
      $italy_20++;
      echo $italy_20;
    }
  }
}
echo $izakaya_20;
echo $cafe_20;
echo $italy_20;
?>