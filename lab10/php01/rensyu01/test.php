<table>
<thead>
  <tr>
    <td>性別</td>
    <td>年代</td>
    <td>評価</td>
    <td>URL</td>
    <td>メモ</td>
  </tr>
</thead>
<tbody>

<?php
// $fileName = ("./toukei.csv");
// $line = file($fileName);
// print_r($line);
// $aray = array("man","10","like","https://play.google.com/store?hl=ja&gl=US","いい店");

$fileName = ("./toukei.csv");
$file = fopen($fileName,"r");

while($gyou = fgetcsv($file)){
  echo '<tr>';
  echo '<td>'.$gyou[0].'</td>';
  echo '<td>'.$gyou[1].'</td>';
  echo '<td>'.$gyou[2].'</td>';
  echo '<td>'.$gyou[3].'</td>';
  echo '</tr>';
}
fclose($fileName);
// echo "<table border='1'><tr>";
// foreach ($line as $val) {
  //   echo "<td>" . $val . "</td>";
  // }
  
  // echo "</tr></table>";
  
  ?>
  </tbody>
  </table>
