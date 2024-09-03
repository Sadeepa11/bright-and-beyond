<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
if(isset($_POST["id"])){

    $pid = $_POST["id"];
    $sid = $_POST["sid"];
    $cid = $_POST["cid"];
    $q = $_POST["q"];
    $umail = $_SESSION["u"]["email"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$umail."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");
    $cart_num = $cart_rs->num_rows;

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();


    $total_price=($product_data["price"]*$q)+$product_data["delivary_fee_colombo"];
    echo($total_price);

    $product_qty = $product_data["qty"];

    if($cart_num == 1){
        $cart_data = $cart_rs->fetch_assoc();
        $current_qty = $cart_data["qty"];
        $new_qty = (int)$current_qty + $q;

        if($product_qty >= $new_qty){

            $q1=$product_qty-$q;

            Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `product_id`='".$pid."' AND `user_email`='".$umail."'");
            Database::iud("UPDATE `product` SET `qty`='".$q1."' WHERE `id`='".$pid."'");

            $p_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='".$pid."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");
            $p_data = $p_rs->fetch_assoc();

            $q2 = $p_data["qty"]-$q;


            Database::iud("UPDATE `product_has_size_and_color` SET `qty`='".$q2."' WHERE `product_id`='".$pid."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");




            echo ("Update Finished");

        }else{
            echo ("Not Enough Quatity");
        }
    }else{

        $q1=$product_qty-$q;

        Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`,`sizes_id`,`colours_id`,`total_price`) VALUES ('".$pid."','".$umail."','".$q."','".$sid."','".$cid."','".$total_price."')");

        Database::iud("UPDATE `product` SET `qty`='".$q1."' WHERE `id`='".$pid."'");

        $p_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='".$pid."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");
        $p_data = $p_rs->fetch_assoc();

        $q2 = $p_data["qty"]-$q;


        Database::iud("UPDATE `product_has_size_and_color` SET `qty`='".$q2."' WHERE `product_id`='".$pid."' AND `sizes_id`='".$sid."' AND `colours_id`='".$cid."'");



        echo ("New Product added to the Cart");

    }

}else{
    echo ("Something Went Wrong");
}
}else{
    echo ("Please Log In or Sign Up");
}

?>