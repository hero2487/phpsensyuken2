<?php

$filename = "./demo.csv";
$izakaya_20 = 0;

$fp = fopen($filename,'r');


while(!feof($fp)){
    $fg = fgetcsv($fp);    
    print_r($fg);
    if($fg[1] == "male" && $fg[1] == "40" && $fg[2] == "居酒屋"){
        $izakaya_20++;
    }else{
        $izakaya_20+"0";
    };
}
echo $izakaya_20;

fclose($filename);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>