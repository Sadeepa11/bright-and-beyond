<?php


require "connection.php";





$clrname = $_POST["clr_in"];


$clr_rs = Database::search("SELECT * FROM `colours` WHERE `colour` = '" . $clrname . "'");
$clr_num = $clr_rs->num_rows;

if ($clr_num == 0) {

    $image = $_FILES["clr_img"];

    $file_ex = $image["type"];

    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");


    if (!in_array($file_ex, $allowed_image_extentions)) {
        echo ("Please select a valid image.");
    } else {

        $new_file_extention;

        if ($file_ex == "image/jpg") {
            $new_file_extention = ".jpg";
        } else if ($file_ex == "image/jpeg") {
            $new_file_extention = ".jpeg";
        } else if ($file_ex == "image/png") {
            $new_file_extention = ".png";
        } else if ($file_ex == "image/svg+xml") {
            $new_file_extention = ".svg";
        }

        $file_name = "src/clr_image/" . $clrname . "_" . uniqid() . $new_file_extention;

        move_uploaded_file($image["tmp_name"], $file_name);

        Database::iud("INSERT INTO `colours`(`colour`,`url`) VALUES ('" . $clrname . "','" . $file_name . "')");
    }

?>

    <div class="row">

        <?php


        $crl_rs = Database::search("SELECT * FROM `colours`");
        $crl_num = $crl_rs->num_rows;

        for ($x = 0; $x < $crl_num; $x++) {
            $crl_data = $crl_rs->fetch_assoc();

        ?>

            <div class="col-2 text-start">
                <input type="checkbox" class="d-none" name="" id="<?php echo $crl_data["id"]; ?>">
                <img src="<?php echo $crl_data["url"]  ?>" alt="" srcset="" style="width: 20px; height: 20px; border-radius: 50%; border: 1px solid black;">
                <label for="<?php echo $crl_data["id"]; ?>"><?php echo $crl_data["colour"]; ?></label>
            </div>

        <?php
        }

        ?>


    </div>

<?php

} else {
    echo ("This Item Already Exists");
}
