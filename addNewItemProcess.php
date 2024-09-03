<?php


require "connection.php";


if (isset($_POST["item_in"])) {


    $itemName = $_POST["item_in"];




    $item_rs = Database::search("SELECT * FROM `item` WHERE `name` = '" . $itemName . "'");
    $item_num = $item_rs->num_rows;

    if ($item_num == 0) {

        Database::iud("INSERT INTO `item`(`name`) VALUES ('" . $itemName . "')");
        echo ("Success");
    } else {
        echo ("This Item Already Exists");
    }
} else {
    echo ("Something Missing");
}
