<?php

require "connection.php";

$pid = $_POST["pid"];
$sid = $_POST["sid"];
$cid = $_POST["cid"];
$qty = $_POST["q"];

$phsc_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `product_id`='" . $pid . "' AND `sizes_id`='" . $sid . "' AND `colours_id`='" . $cid . "' ");
$phsc_num = $phsc_rs->num_rows;

if ($phsc_num != 0) {
    Database::iud("UPDATE `product_has_size_and_color` SET `qty`='" . $qty . "' WHERE `product_id`='" . $pid . "' AND `sizes_id`='" . $sid . "' AND `colours_id`='" . $cid . "' ");

    echo("success");
} else {
    Database::iud("INSERT INTO `product_has_size_and_color` (`product_id`,`sizes_id`,`colours_id`,`qty`) VALUES ('" . $pid . "','" . $sid . "','" . $cid . "','" . $qty . "')");

    echo("success");
}
