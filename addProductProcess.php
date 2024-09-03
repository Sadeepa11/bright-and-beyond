<?php

// session_start();
require "connection.php";

$category = $_POST["ca"];
$item = $_POST["i"];
$title = $_POST["t"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
// $doc = $_POST["doc"];
$desc = $_POST["desc"];
$colours = $_POST["col"]; // Retrieve the array of checked colour IDs
$sizes = $_POST["size"]; // Retrieve the array of checked csize IDs





if ($category == "0") {
    echo ("Error: Please select a Category");
} else if ($item == "0") {
    echo ("Error: Please select an Item");
} else if (empty($title)) {
    echo ("Error: Please add the Title");
} else if (strlen($title) >= 200) {
    echo ("Error: Title should have less than 200 characters");
} else if (empty($cost)) {
    echo ("Error: Please add the Cost");
} else if (!is_numeric($cost)) {
    echo ("Error: Invalid value for field Cost Per Item");
} else if (empty($dwc)) {
    echo ("Error: Please add the Cost for Delivery ");
} else if (!is_numeric($dwc)) {
    echo ("Error: Invalid value for field Delivery cost");
} else if (empty($desc)) {
    echo ("Error: Please add the Description");
} else {





    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product` (`price`,`description`,`title`,`date_time`,`delivary_fee_colombo`,`catogary_id`,`item_id`,`status_id`) 
    VALUES ('" . $cost . "','" . $desc . "','" . $title . "','" . $date . "','" . $dwc . "','" . $category . "','" . $item . "','" . $status . "')");

    $product_id = Database::$connection->insert_id;

    foreach ($colours as $colour) {
        Database::iud("INSERT INTO `product_has_colours` (`product_id`,`colours_id`) 
        VALUES ('" . $product_id . "','" . $colour . "')");
    }

    foreach ($sizes as $size) {
        Database::iud("INSERT INTO `product_has_sizes` (`product_id`,`sizes_id`) 
        VALUES ('" . $product_id . "','" . $size . "')");
    }

    $chi_rs = Database::search("SELECT * FROM `catogary_has_item` WHERE `catogary_id` = '" . $category . "' AND `item_id` = '" . $item . "' ");
    $chi_num = $chi_rs->num_rows;

    if ($chi_num == 0) {
        Database::iud("INSERT INTO `catogary_has_item`(`catogary_id`,`item_id`) VALUES ('" . $category . "','" . $item . "')");
    }

    $length = sizeof($_FILES);

    if ($length <= 6 && $length > 0) {

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {

                $image_file = $_FILES["image" . $x];
                $file_extention = $image_file["type"];

                if (in_array($file_extention, $allowed_image_extentions)) {

                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "src//products_imgs//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_image`(`url`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
                } else {
                    echo ("Error: Not an allowed image type");
                }
            }
        }

        echo ($product_id);
    } else {
        echo ("Error: Invalid Image Count");
    }
}

?>
