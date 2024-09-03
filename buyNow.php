<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $id = $_POST["id"];
    $sizeId = $_POST["sizeId"];
    $colorId = $_POST["colorId"];
    $qty = $_POST["qty"];
    $umail = $_SESSION["u"]["email"];

    $array = [];

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
    $product_data = $product_rs->fetch_assoc();

    $qty_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='".$id."' AND `sizes_id`='".$sizeId."' AND `colours_id`='".$colorId."'");
    $qty_data = $qty_rs->fetch_assoc();

    if ( $qty_data['qty'] >= $qty) {

        $city_rs = Database::search("SELECT * FROM `user_has_addres` WHERE `user_email`='$umail'");
        $city_num = $city_rs->num_rows;

        if ($city_num == 1) {
            $city_data = $city_rs->fetch_assoc();

            $city_id = $city_data["city_id"];
            $address = $city_data["line 1"] . "," . $city_data["line 2"];

            $city_id = $city_data["id"];

            $city_id_rs = Database::search("SELECT * FROM `city` WHERE `id`='$city_id'");
            $city_id_data = $city_id_rs->fetch_assoc();

            $city = $city_id_data["name"];

            $delivery = $product_data["delivary_fee_colombo"];

            $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

            $merchant_id = "1226135"; // Replace with your actual merchant ID
            $merchant_secret = "MTEzNTkzODM2NjI0Mjc2NTQyMDAzNTQ2ODQ0ODA3MTQ4MDA0MzA2Nw=="; // Replace with your actual merchant secret
            $currency = "USD"; // Replace with your actual currency

            // Calculate the hash
            $hash = strtoupper(
                md5(
                    $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
                )
            );

            $item = $product_data["title"];

            $fname = $_SESSION["u"]["fname"];
            $lname = $_SESSION["u"]["lname"];
            $mobile = $_SESSION["u"]["mobile"];
            $uaddress = $address;

            $array["id"] = $order_id;
            $array["item"] = $item;
            $array["amount"] = $amount;
            $array["fname"] = $fname;
            $array["lname"] = $lname;
            $array["mobile"] = $mobile;
            $array["address"] = $uaddress;
            $array["city"] = $city;
            $array["umail"] = $umail;
            $array["hash"] = $hash; // Add the hash value to the array

            echo json_encode($array);

            $newQty = $qty_data["qty"]-$qty;
            $newQty1 = $product_data["qty"]-$qty;

//            Database::iud(" UPDATE `product_has_size_and_color`
// SET `qty` = '".$newQty."' WHERE `product_id`='".$id."' AND `sizes_id`='".$sizeId."' AND `colours_id`='".$colorId."'");

// Database::iud(" UPDATE `product`
// SET `qty` = '".$newQty1."' WHERE `id`='".$id."' ");
           
        

            
        } else {
            echo ("2");
        }
    } else {
        // echo ("Insufficient quantity");
        echo ("3");
    }
} else {
    echo ("1");
}
