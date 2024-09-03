<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    // $cartId = $_POST["cartId"];
    $orderId = $_POST["orderId"];
    $amount = $_POST["amount"];
    $mail = $_POST["mail"];

    $cartRs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$mail."'");
    $cartNum = $cartRs->num_rows;



    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`user_email`,`cartId`) VALUES 
        ('" . $orderId . "','" . $date . "','" . $amount . "','" . $mail . "','1')");

    $invoice_id = Database::$connection->insert_id;

    for ($z = 0; $z < $cartNum; $z++) {

        $cartData = $cartRs->fetch_assoc();

        $pid = $cartData['product_id'];
        $size = $cartData['sizes_id'];
        $colour = $cartData['colours_id'];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $qty = $cartData["qty"];
        $current_qty = $product_data["qty"];
        $new_qty = $current_qty - $qty;

        $product1_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='" . $pid . "' AND `sizes_id`='" . $size . "' AND `colours_id`='" . $colour . "'");
        $product1_data = $product1_rs->fetch_assoc();

        $current1_qty = $product1_data["qty"];
        $new_qty1 = $current1_qty - $qty;

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");
        Database::iud("UPDATE `product_has_size_and_color` SET `qty`='" . $new_qty1 . "' WHERE `product_id`='" . $pid . "' AND `sizes_id`='" . $size . "' AND `colours_id`='" . $colour . "'");





        Database::iud("INSERT INTO `invoice_has_product`(`invoice_id`,`get_qty`,`product_id`,`status`,`colours_id`,`sizes_id`) VALUES 
        ('" . $invoice_id . "','" . $qty . "','" . $pid . "','0','" . $colour . "','" . $size . "')");
    }
    
    echo "1";
    
} else {
    echo "Error";
}
