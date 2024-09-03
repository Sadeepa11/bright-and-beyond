<?php

require "connection.php";

$product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
$product_data = $product_rs->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Quantity</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12 container-fluid d-flex justify-content-center align-items-center mt-2 ">

        <div class="row col-12">

            <div class="col-12 text-center">
                <h2>Add Product Quantity</h2>

                <br>

                <h4 style="color:dimgrey;"><?php echo $product_data["title"] ?></h4>

                <br>
                <?php
                $phs_rs = Database::search("SELECT * FROM `product_has_sizes` WHERE `product_id` = '" . $product_id . "' ");
                $phs_num = $phs_rs->num_rows;
                ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <select class="form-select" id="size" aria-placeholder="">

                                <option value="0">Select the Size</option>

                                <?php
                                $phs_rs = Database::search("SELECT * FROM `product_has_sizes` WHERE `product_id`= '" . $product_data['id'] . "'");

                                $phs_num = $phs_rs->num_rows;


                                for ($z = 0; $z < $phs_num; $z++) {
                                    $phs_data = $phs_rs->fetch_assoc();




                                    $size_rs = Database::search("SELECT * FROM `sizes` WHERE `id`='" . $phs_data['sizes_id'] . "' ");
                                    $size_num = $size_rs->num_rows;

                                    for ($a = 0; $a < $size_num; $a++) {
                                        $size_data = $size_rs->fetch_assoc();

                                ?>



                                        <option value="<?php echo $size_data["id"]; ?>"><?php echo $size_data["size"]; ?></option>


                                    <?php
                                    }

                                    ?>
                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-4">
                            <select class="form-select" id="clr">
                                <option value="0">Select the Colour</option>


                                <?php
                                $phc_rs = Database::search("SELECT * FROM `product_has_colours` WHERE `product_id`= '" . $product_data['id'] . "'");

                                $phc_num = $phc_rs->num_rows;


                                for ($y = 0; $y < $phc_num; $y++) {
                                    $phc_data = $phc_rs->fetch_assoc();




                                    $clr_rs = Database::search("SELECT * FROM `colours` WHERE `id`='" . $phc_data['colours_id'] . "' ");
                                    $clr_num = $clr_rs->num_rows;

                                    for ($x = 0; $x < $clr_num; $x++) {
                                        $clr_data = $clr_rs->fetch_assoc();

                                ?>
                                        <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["colour"]; ?></option>


                                    <?php
                                    }

                                    ?>
                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-4"><input type="text" id="qty" class=" form-control" placeholder="Enter the Product Quatity"></div>
                    </div>
                </div>


                <div class="col-12 mt-4">

                    <button class="offset-4 mx-5 col-1 btn btn-outline-dark" onclick="clear()">Clear</button>

                    <button class=" col-1 btn btn-dark" onclick="saveQty(<?php echo $product_id ?>);"> Add Quantity</button>


                </div>


            </div>



            <div class="col-12 mt-1">

                <div class="col-12 p-3 " style=" border: 1px solid black; border-radius: 10px; margin-top: 8px;">

                    <div class="row">

                        <div class="col-4 text-center">
                            <label class=" fs-5 fw-bold">Size</label>
                        </div>
                        <div class="col-4 text-center">
                            <label class="  fs-5 fw-bold">Colour</label>
                        </div>
                        <div class="col-4 text-center">
                            <label class=" fs-5 fw-bold">Quantity</label>
                        </div>
                    </div>


                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="row">
                            <?php
                            $phs_rs = Database::search("SELECT * FROM `product_has_sizes` WHERE `product_id`= '" . $product_id . "'");
                            $phs_num = $phs_rs->num_rows;

                            while ($phs_data = $phs_rs->fetch_assoc()) {
                                $size_rs = Database::search("SELECT * FROM `sizes` WHERE `id`='" . $phs_data['sizes_id'] . "' ");
                                $size_data = $size_rs->fetch_assoc();
                            ?>
                                <div class="col-12" style="border-radius: 10px;">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <label class=" fs-1 "> <?php echo $size_data["size"] ?></label>
                                        </div>
                                        <div class="col-4 text-center">
                                            <?php
                                            $phc_rs = Database::search("SELECT * FROM `product_has_colours` WHERE `product_id`= '" . $product_data['id'] . "'");
                                            $phc_num = $phc_rs->num_rows;

                                            while ($phc_data = $phc_rs->fetch_assoc()) {
                                                $crl_rs = Database::search("SELECT * FROM `colours` WHERE `id`='" . $phc_data['colours_id'] . "' ");
                                                $crl_data = $crl_rs->fetch_assoc();
                                            ?>
                                                <label class=" mb-2 "><?php echo $crl_data["colour"] ?></label><br>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-4 text-center">
                                            <?php
                                            $phc_rs = Database::search("SELECT * FROM `product_has_colours` WHERE `product_id`= '" . $product_data['id'] . "'");
                                            $phc_num = $phc_rs->num_rows;

                                            while ($phc_data = $phc_rs->fetch_assoc()) {
                                                $phsc_rs = Database::search("SELECT * FROM `product_has_size_and_color` WHERE `colours_id`='" . $phc_data['colours_id'] . "' AND `sizes_id`='" . $size_data['id'] . "' AND `product_id`='" . $product_id . "' ");
                                                $phsc_data = $phsc_rs->fetch_assoc();

                                            ?>
                                                <?php if (empty($phsc_data["qty"])) : ?>
                                                    <label class=" mb-2 ">null</label><br>
                                                <?php else : ?>
                                                    <label class=" mb-2 "><?php echo $phsc_data["qty"] ?></label><br>
                                                <?php endif; ?>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php
                            }
                            ?>
                        </div>


                    </div>



                </div>


            </div>

        </div>


    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

    <script>
        function clear() {
            alert("Your clear functionality here");
        }
    </script>
</body>

</html>