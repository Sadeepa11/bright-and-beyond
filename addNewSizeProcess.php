<?php


require "connection.php";


if (isset($_POST["size_in"])) {


    $sizename = $_POST["size_in"];


    $size_rs = Database::search("SELECT * FROM `sizes` WHERE `size` = '" . $sizename . "'");
    $size_num = $size_rs->num_rows;

    if ($size_num == 0) {

        Database::iud("INSERT INTO `sizes`(`size`) VALUES ('" . $sizename . "')");


        ?>

        <div class="row">

        <?php


        $size_rs = Database::search("SELECT * FROM `sizes`");
        $size_num = $size_rs->num_rows;

        for ($x = 0; $x < $size_num; $x++) {
            $size_data = $size_rs->fetch_assoc();

        ?>

            <div class="col-6 text-start">
                <input type="checkbox" name="" id="<?php echo $size_data["id"]; ?>">
                <label for="<?php echo $size_data["id"]; ?>"><?php echo $size_data["size"]; ?></label>
            </div>


        <?php
        }

        ?>


    </div>

<?php

        
    } else {
        echo ("This Item Already Exists");
    }
} else {
    echo ("Something Missing");
}
?>