<?php

require "connection.php";





$product_id = $_GET["id"];



$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
$product_data = $product_rs->fetch_assoc();


?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Products</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />



</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">
            <!-- <?php include "header.php"; ?> -->



            <div class="col-12">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="h2 text-dark fw-bold">Update This Style</h2>
                    </div>

                    <div class="col-12">
                        <div class="row">



                            <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Catogary</label>
                                    </div>

                                    <?php

                                    $category_rs = Database::search("SELECT * FROM `catogary` WHERE `id`='" . $product_data["catogary_id"] . "'");
                                    $category_num = $category_rs->num_rows;
                                    $category_data = $category_rs->fetch_assoc();

                                    ?>




                                    <select id="category" class="col-12" disabled>

                                        <?php










                                        ?>

                                        <option><?php echo $category_data["name"]; ?></option>



                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#category').selectize({
                                                sortField: 'text'
                                            });
                                        });
                                    </script>



                                </div>
                            </div>



                            <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Item</label>
                                    </div>

                                    <?php

                                    $item_rs = Database::search("SELECT * FROM `item` WHERE `id` = '" . $product_data['item_id'] . "'");
                                    $item_num = $item_rs->num_rows;


                                    $item_data = $item_rs->fetch_assoc();


                                    ?>



                                    <select id="item" disabled>


                                        <option value="<?php echo $item_data["id"]; ?>"><?php echo $item_data["name"]; ?></option>




                                    </select>

                                    <script>
                                        $(document).ready(function() {
                                            $('#item').selectize({
                                                sortField: 'text'
                                            });
                                        });
                                    </script>

                                    <div class="col-12">
                                        <div class="input-group mt-2 mb-2">

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12">
                                <br>
                            </div>

                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">
                                            Add a name to your Product
                                        </label>
                                    </div>
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                        <input type="text" class="form-control" id="t" value="<?php echo $product_data['title'] ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <br>
                            </div>

                            <div class="col-12">
                                <div class="row">


                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                            </div>

                                            <div class="col-12 clrCheckBoxes" style="overflow-y: scroll; max-height: 15vh;">
                                                <div class="row">

                                                    <?php
                                                    $phc_rs = Database::search("SELECT * FROM `product_has_colours` WHERE `product_id`= '" . $product_data['id'] . "'");

                                                    $phc_num = $phc_rs->num_rows;


                                                    for ($y = 0; $y < $phc_num; $y++) {
                                                        $phc_data = $phc_rs->fetch_assoc();




                                                        $crl_rs = Database::search("SELECT * FROM `colours` WHERE `id`='" . $phc_data['colours_id'] . "' ");
                                                        $crl_num = $crl_rs->num_rows;

                                                        for ($x = 0; $x < $crl_num; $x++) {
                                                            $crl_data = $crl_rs->fetch_assoc();

                                                    ?>

                                                            <div class="col-6 text-start">
                                                                <input type="checkbox" name="" id="<?php echo $crl_data["id"]; ?>" checked disabled>
                                                                <label for="<?php echo $crl_data["id"]; ?>"><?php echo $crl_data["colour"]; ?></label>
                                                            </div>


                                                        <?php
                                                        }

                                                        ?>
                                                    <?php
                                                    }

                                                    ?>


                                                </div>
                                            </div>




                                            <div class="col-12">
                                                <div class="input-group mt-2 mb-2">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Size</label>
                                            </div>

                                            <div class="col-12 sizeCheckBoxes" style="overflow-y: scroll; max-height: 15vh;">
                                                <div class="row">



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

                                                            <div class="col-6 text-start">
                                                                <input type="checkbox" name="" id="<?php echo $size_data["id"]; ?>" checked disabled>
                                                                <label for="<?php echo $size_data["id"]; ?>"><?php echo $size_data["size"]; ?></label>
                                                            </div>


                                                        <?php
                                                        }

                                                        ?>
                                                    <?php
                                                    }

                                                    ?>






                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group mt-2 mb-2">

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-success" />
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-6 ">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <div class="input-group mb-2 mt-2">
                                                    <span class="input-group-text">USD</span>
                                                    <input type="text" class="form-control" id="cost" value=" <?php echo $product_data["price"] ?>" disabled />
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                        <div class="row">
                                        <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="input-group mb-2 mt-2">
                                                    <span class="input-group-text">USD</span>
                                                    <input type="text" class="form-control" id="dwc" value=" <?php echo $product_data["delivary_fee_colombo"] ?>" />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="col-12">
                                <br>
                            </div>

                           

                            <!-- <div class="col-12">
                                <hr class="border-success" />
                            </div> -->

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                    </div>

                                    <div class="col-12">
                                        <textarea name="editor1" id="editor1" rows="10" cols="50">
              <?php echo $product_data["description"] ?>
            </textarea>
                                    </div>

                                    <div class="col-12">
                                        <textarea id="d" style="width: 500px; height: 200px; border: 2px solid black; border-radius: 10px; display: none;"></textarea>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace('editor1');

                           
                            </script>


                            <div class="col-12">
                                <hr class="border-success" />
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6">

                                        <?php
                                        $img = array();

                                        $img[0] = "src/images/addproductimg.png";
                                        $img[1] = "src/images/addproductimg.png";
                                        $img[2] = "src/images/addproductimg.png";
                                        $img[3] = "src/images/addproductimg.png";
                                        $img[4] = "src/images/addproductimg.png";
                                        $img[5] = "src/images/addproductimg.png";

                                        $product_img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
                                        $product_img_num = $product_img_rs->num_rows;

                                        for ($x = 0; $x < $product_img_num; $x++) {
                                            $product_img_data = $product_img_rs->fetch_assoc();

                                            $img[$x] = $product_img_data["url"];
                                        }

                                        ?>
                                        <div class="row">
                                            <div class="col-4 border border-dark rounded" style="height: 260px;">
                                                <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px; height: 250px;" id="i0" />
                                            </div>
                                            <div class="col-4 border border-dark rounded" style="height: 260px;">
                                                <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px; height: 250px;" id="i1" />
                                            </div>
                                            <div class="col-4 border border-dark rounded" style="height: 260px;">
                                                <img src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px; height: 250px;" id="i2" />
                                            </div>
                                            <div class="col-4 border border-dark rounded" style="height: 260px;">
                                                <img src="<?php echo $img[3]; ?>" class="img-fluid" style="width: 250px; height: 250px;" id="i0" />
                                            </div>
                                            <div class="col-4 border border-dark rounded" style="height: 260px;">
                                                <img src="<?php echo $img[4]; ?>" class="img-fluid" style="width: 250px; height: 250px;" id="i1" />
                                            </div>
                                            <div class="col-4 border border-dark rounded" style="height: 260px;">
                                                <img src="<?php echo $img[5]; ?>" class="img-fluid" style="width: 250px; height: 250px;" id="i2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader" class="col-12 btn btn-dark" onclick="changeProductImage();">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                               <br>
                            </div>



                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-secondary" onclick="updateProduct(<?php echo $product_data['id'] ?>);">Update Style</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>