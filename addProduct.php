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
                        <h2 class="h2 text-dark fw-bold">Add New Style</h2>
                    </div>

                    <div class="col-12">
                        <div class="row">



                            <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Category</label>
                                    </div>



                                    <select id="category" onchange="loadItems();">
                                        <option value="">Select Category</option>
                                        <?php

                                        require "connection.php";

                                        $category_rs = Database::search("SELECT * FROM `catogary`");
                                        $category_num = $category_rs->num_rows;

                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

                                        <?php
                                        }

                                        ?>

                                    </select>

                                    <script>
                                        $(document).ready(function() {
                                            $('#category').selectize({
                                                sortField: 'text'
                                            });
                                        });
                                    </script>

                                    <div class="col-12">
                                        <div class="input-group mt-2 mb-2">
                                            <input type="text" class="form-control" placeholder="Add new Category" id="cat_in" />
                                            <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addCat();">+ Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Item</label>
                                    </div>



                                    <select id="item">
                                        <option value="">Select Item</option>
                                        <?php



                                        $item_rs = Database::search("SELECT * FROM `item`");
                                        $item_num = $item_rs->num_rows;

                                        for ($x = 0; $x < $item_num; $x++) {
                                            $item_data = $item_rs->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $item_data["id"]; ?>"><?php echo $item_data["name"]; ?></option>

                                        <?php
                                        }
                                        ?>

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
                                            <input type="text" class="form-control" placeholder="Add new Item" id="item_in" />
                                            <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addItem();">+ Add</button>
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
                                            Add a Name to your Product
                                        </label>
                                    </div>
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                        <input type="text" class="form-control" id="title" />
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

                                            <div class="col-12 clrCheckBoxes" id="clrCheckBoxes" style="overflow-y: scroll; max-height: 15vh;">
                                                <div class="row">
                                                    <?php
                                                    $crl_rs = Database::search("SELECT * FROM `colours`");
                                                    $crl_num = $crl_rs->num_rows;

                                                    for ($x = 0; $x < $crl_num; $x++) {
                                                        $crl_data = $crl_rs->fetch_assoc();
                                                    ?>
                                                        <div class="col-2 text-start">
                                                            <input type="checkbox" class="" name="" id="<?php echo $crl_data["id"]; ?>">
                                                            <img src="<?php echo $crl_data["url"]  ?>" alt="" srcset="" style="width: 20px; height: 20px; border-radius: 50%; border: 2px solid black ; " id=" <?php echo $crl_data["id"]; ?>" />
                                                            <label for="<?php echo $crl_data["id"]; ?>"><?php echo $crl_data["colour"]; ?></label>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            




                                            <div class="col-12">
                                                <div class="input-group mt-2 mb-2">
                                                    <input type="file" class="d-none" placeholder="Add new Colour" id="clr_img" />
                                                    <label onclick="" for="clr_img" class="btn btn-dark" id="clr_img">Colour Image</label>
                                                    <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in" />
                                                    <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addColour();">+ Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Size</label>
                                            </div>

                                            <div class="col-12 sizeCheckBoxes" id="sizeCheckBoxes" style="overflow-y: scroll; max-height: 15vh;">
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
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group mt-2 mb-2">
                                                    <input type="text" class="form-control" placeholder="Add new Size" id="size_in" />
                                                    <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addSize();">+ Add</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <br>
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6 ">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <div class="input-group mb-2 mt-2">
                                                    <span class="input-group-text">USD</span>
                                                    <input type="text" class="form-control" id="cost" />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 
                                    <div class="col-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12">
                                            <div class="input-group mb-2 mt-2">
                                                    <span class="input-group-text">USD</span>
                                                    <input type="text" class="form-control" id="dwc" />
                                                    
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
                                <hr class="border-success" />
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                    </div>

                                    <div class="col-12">
                                        <textarea name="editor1" id="editor1" rows="10" cols="50">

            </textarea>
                                    </div>

                                    <div class="col-12">
                                        <textarea id="desc" style="width: 500px; height: 200px; border: 2px solid black; border-radius: 10px; display: none;"></textarea>
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
                                    <div class="offset-lg-1 col-12 col-lg-10">
                                        <div class="row">
                                            <div class="col-2 border border-dark rounded">
                                                <img src="src/images/addproductimg.png" class="img-fluid" style="width: 250px;" id="i0" />
                                            </div>
                                            <div class="col-2 border border-dark rounded">
                                                <img src="src/images/addproductimg.png" class="img-fluid" style="width: 250px;" id="i1" />
                                            </div>
                                            <div class="col-2 border border-dark rounded">
                                                <img src="src/images/addproductimg.png" class="img-fluid" style="width: 250px;" id="i2" />
                                            </div>
                                            <div class="col-2 border border-dark rounded">
                                                <img src="src/images/addproductimg.png" class="img-fluid" style="width: 250px;" id="i3" />
                                            </div>
                                            <div class="col-2 border border-dark rounded">
                                                <img src="src/images/addproductimg.png" class="img-fluid" style="width: 250px;" id="i4" />
                                            </div>
                                            <div class="col-2 border border-dark rounded">
                                                <img src="src/images/addproductimg.png" class="img-fluid" style="width: 250px;" id="i5" />
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
                                <hr class="border-success" />
                            </div>



                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-secondary" onclick="addProduct();">Add Style</button>
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