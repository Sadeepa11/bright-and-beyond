<?php


require "connection.php";


if (isset($_POST["cat_in"])) {


    $cname = $_POST["cat_in"];


    $category_rs = Database::search("SELECT * FROM `catogary` WHERE `name` = '" . $cname . "'");
    $category_num = $category_rs->num_rows;

    if ($category_num == 0) {

        Database::iud("INSERT INTO `catogary`(`name`) VALUES ('" . $cname . "')");
        echo ("Success");
    } else {
        echo ("This Category Already Exists");
    }
} else {
    echo ("Something Missing");
}
