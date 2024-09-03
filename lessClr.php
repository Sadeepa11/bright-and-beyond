<?php

require "connection.php";
$crl_rs = Database::search("SELECT * FROM `colours` LIMIT 8");
$crl_num = $crl_rs->num_rows;

for ($x = 0; $x < $crl_num; $x++) {
    $crl_data = $crl_rs->fetch_assoc();
?>
    <div class="col-3">
        <div class="row mb-1  mt-2">





            <div class=" col-12 form-check">
                <input class="form-check-input clrR" type="radio" name=" " id="<?php echo $crl_data["id"]; ?>">
                <img src="<?php echo $crl_data["url"]  ?>" onclick="toggleSelected(this);" alt="" srcset="" style="width: 20px; height: 20px; border-radius: 50%; border: 1px solid black;  " class="clrI" id=" <?php echo $crl_data["id"]; ?>" />
            </div>





        </div>



    </div>
<?php
}
?>