<?php
$filename = "./total.csv";
$fp = fopen($filename,'r');
$get = fgets($fp);

$t = explode(",",$get);
print_r($t);


?>

