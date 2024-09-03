<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $total = $_POST["total"];
    // $sizeId = $_POST["sizeId"];
    // $colorId = $_POST["colorId"];
    // $qty = $_POST["qty"];
    $umail = $_SESSION["u"]["email"];

    $array = [];

    $order_id = uniqid();

    // Fetch user address
    $city_rs = Database::search("SELECT * FROM `user_has_addres` WHERE `user_email`='$umail'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {
        $city_data = $city_rs->fetch_assoc();
        $city_id = $city_data["city_id"];
        $address = $city_data["line 1"] . "," . $city_data["line 2"];

        // Fetch city name
        $city_id_rs = Database::search("SELECT * FROM `city` WHERE `id`='$city_id'");
        $city_id_data = $city_id_rs->fetch_assoc();
        $city = $city_id_data["name"];

        // Assuming $product_data is defined somewhere in the script
        // $delivery = $product_data["delivary_fee_colombo"];

        $amount = $total; // Adjust if needed

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

        $item = "Cart Items";

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

        // Update quantities in the database (assuming $qty_data and $product_data are defined)
     

        // Database::iud("UPDATE `product_has_size_and_color` SET `qty` = '$newQty' WHERE `product_id` = '$id' AND `sizes_id` = '$sizeId' AND `colours_id` = '$colorId'");
        // Database::iud("UPDATE `product` SET `qty` = '$newQty1' WHERE `id` = '$id'");
    } else {
        echo "2"; // Address not found
    }

} else {
    echo "1"; // User session not set
}

?>
