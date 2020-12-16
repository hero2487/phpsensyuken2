<?php
// セッションの時は必須
session_start();

$_SESSION["name"] = "Nishiyama";
$_SESSION["age"] = "30";
$_SESSION["add"] = "Oosaka";

echo "<br>";
echo session_id();