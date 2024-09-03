<?php

require "connection.php";

if(isset($_GET["id"])){

    $caid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='".$caid."'");
    $cart_data = $cart_rs->fetch_assoc();

    $umail = $cart_data["user_email"];
    $pid = $cart_data["product_id"];
    $sid = $cart_data["sizes_id"];
    $cid = $cart_data["colours_id"];


    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $newQty = $product_data["qty"]+$cart_data["qty"];


    Database::iud("UPDATE `product` SET `qty`='".$newQty."' WHERE `id`='".$cart_data['product_id']."'");



    $p_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='".$pid."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");
    $p_data = $p_rs->fetch_assoc();

    $q2 = $p_data["qty"]+$cart_data["qty"];


    Database::iud("UPDATE `product_has_size_and_color` SET `qty`='".$q2."' WHERE `product_id`='".$pid."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");






    // Database::iud("INSERT INTO `recent`(`product_id`,`user_email`) VALUES ('".$pid."','".$umail."')");
    Database::iud("DELETE FROM `cart` WHERE `id`='".$caid."'");



    

    echo ("Product has been removed");

}else{
    echo ("something went wrong");
}

?>