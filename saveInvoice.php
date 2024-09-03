<?php

use FTP\Connection;

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];
    $size = $_POST["s"];
    $colour = $_POST["c"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $current_qty = $product_data["qty"];
    $new_qty = $current_qty - $qty;

    $product1_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='".$pid."' AND `sizes_id`='".$size."' AND `colours_id`='".$colour."'");
    $product1_data = $product1_rs->fetch_assoc();

    $current1_qty = $product1_data["qty"];
    $new_qty1 = $current1_qty - $qty;

    Database::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$pid."'");
    Database::iud("UPDATE `product_has_size_and_color` SET `qty`='".$new_qty1."' WHERE `product_id`='".$pid."' AND `sizes_id`='".$size."' AND `colours_id`='".$colour."'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`user_email`,`cartId`) VALUES 
    ('".$order_id."','".$date."','".$amount."','".$mail."','0')");

$invoice_id = Database::$connection->insert_id;

    Database::iud("INSERT INTO `invoice_has_product`(`invoice_id`,`get_qty`,`product_id`,`status`,`colours_id`,`sizes_id`) VALUES 
    ('".$invoice_id."','".$qty."','".$pid."','0','".$colour."','".$size."')");

    echo ("1");

}

?>