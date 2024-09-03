<?php

require "connection.php";
$size_rs = Database::search("SELECT * FROM `sizes` LIMIT 8");
$size_num = $size_rs->num_rows;

for ($x = 0; $x < $size_num; $x++) {
    $size_data = $size_rs->fetch_assoc();

?>

    <div class=" col-3 form-check">
        <input class="form-check-input sizeR" type="radio" name="r1" id="<?php echo $size_data["id"]; ?>">
        <label class="form-check-label" for="<?php echo $size_data["id"]; ?>">
            <?php echo $size_data["size"]; ?>
        </label>
    </div>



<?php
}

?>