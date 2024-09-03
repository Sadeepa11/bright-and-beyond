<?php

require "connection.php";


$item_rs = Database::search("SELECT * FROM `item`");
$item_num = $item_rs->num_rows;

for ($x = 0; $x < $item_num; $x++) {
    $item_data = $item_rs->fetch_assoc();

?>

    <div class=" form-check">
        <input class="form-check-input itemR" type="radio" name="" id="<?php echo $item_data["id"]; ?>">
        <label class="form-check-label" for="<?php echo $item_data["id"]; ?>">
            <?php echo $item_data["name"]; ?>
        </label>
    </div>





<?php
}

?>