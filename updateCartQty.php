<?php 
require "connection.php";


$cart_id=$_POST["c_id"];
$qty=$_POST["qty"];



Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `id`='".$cart_id."'");

echo ("success");




?>