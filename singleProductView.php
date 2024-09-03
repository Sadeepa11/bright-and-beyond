<?php

require "connection.php";

if (isset($_GET["id"])) {


    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`= '" . $pid . "' ");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | Bright & Beyond</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resource/logo.svg" />

            <link rel="stylesheet" href="./assets/css/style.css">

            <!-- 
  - google font link
-->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">


        </head>

        <body>


            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 mt-0 bg-white">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">

                                <h3>Product View</h3>

                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">

                                        <div class="row ">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">Product View</li>
                                                </ol>
                                            </nav>
                                        </div>
                                        <ul>

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["url"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                 mb-1">
                                                        <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-1 mb-1" style="height: 70px; width:80px;" id="productImg<?php echo $x; ?>" onclick="loadImg(<?php echo $x ?>);" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="src/images/addproductimg.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="src/images/addproductimg.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="src/images/addproductimg.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }

                                            ?>


                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block" style="margin-top: 5.5vh;">
                                        <div class="row">
                                            <div class="col-12 align-items-center ">
                                                <?php
                                                $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='$pid'");
                                                $image_num = $image_rs->num_rows;
                                                $img = array();

                                                if ($image_data = $image_rs->fetch_assoc()) {
                                                    $img[0] = $image_data["url"];
                                                } else {
                                                    // Handle case when $image_data is null, e.g., show a default image
                                                    $img[0] = "src/images/addproductimg.svg";
                                                }
                                                ?>

                                                <div class="mainImg d-flex justify-content-center " style="margin-left: -10%;">

                                                    <img id="mainImg" height="600px" style="width: 400px; height: 500px;" src="<?php echo $img[0]; ?>" alt="" srcset="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">



                                                <div class="row ">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-black"><?php echo $product_data["title"] ?></span>
                                                    </div>
                                                </div>




                                                <?php
                                                $price = $product_data["price"];
                                                $addttion = $price * 0.1;
                                                $fakePrice = $price + $addttion;
                                                ?>

                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <div class="d-flex align-items-center">
                                                            <span class="fs-4 text-dark fw-bold me-2">USD <?php echo $fakePrice; ?></span>
                                                            <span>|</span>
                                                            <span class="fs-4 text-danger fw-bold mx-2">USD <?php echo $price; ?>.00</span>
                                                            <span>|</span>
                                                            <span class="fs-4 fw-bold text-black-50 ms-2">Save USD <?php echo $addttion; ?>   10%</span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12">
                                                        <?php


                                                        $result = Database::search("SELECT SUM(qty) AS total_qty FROM product_has_size_and_color WHERE product_id = '" . $pid . "'");
                                                        $data = $result->fetch_assoc();
                                                        $total_qty = $data['total_qty'];

                                                        ?>






                                                        <span class="fs-5 text-primary"><b>In Stock : </b><?php echo $total_qty ?> Items Available</span>
                                                        <label for="">Size Chart</label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">

                                                                <div class="col-12">
                                                                    <label for="" class=" mb-2 fs-4">
                                                                        Sizes
                                                                    </label>
                                                                </div>
                                                                <div class="row">
                                                                    <?php
                                                                    $phs_rs = Database::search("SELECT * FROM `product_has_sizes` WHERE `product_id`= '" . $product_data['id'] . "'");
                                                                    $phs_num = $phs_rs->num_rows;

                                                                    for ($z = 0; $z < $phs_num; $z++) {
                                                                        $phs_data = $phs_rs->fetch_assoc();

                                                                        $size_rs = Database::search("SELECT * FROM `sizes` WHERE `id`='" . $phs_data['sizes_id'] . "' ");
                                                                        $size_data = $size_rs->fetch_assoc();
                                                                        $size_id = $size_data['id'];
                                                                        $size_name = $size_data['size'];

                                                                        $rs = Database::search("SELECT SUM(qty) AS qty FROM product_has_size_and_color WHERE `product_id` = '" . $pid . "' AND `sizes_id`='" . $size_id . "'");
                                                                        $d = $rs->fetch_assoc();
                                                                        $qty = $d['qty'];

                                                                        if ($qty != null) {
                                                                    ?>
                                                                            <div class="col-auto mx-3">
                                                                                <label>
                                                                                    <input type="radio" class="d-none" name="size" id="<?php echo $size_id; ?>" value="<?php echo $size_id; ?>" onclick="changeBorderColor(this);">
                                                                                    <label id="label_<?php echo $size_id; ?>" style="border: 2px solid black; width: 50px; border-radius: 5px;" class="d-flex justify-content-center align-items-center" for="<?php echo $size_id; ?>" onclick="a(<?php echo $size_id; ?>);"> <?php echo $size_name ?> </label>
                                                                                </label>
                                                                            </div>

                                                                            <script>
                                                                                function changeBorderColor(element) {
                                                                                    var labels = document.querySelectorAll('[id^="label_"]');
                                                                                    labels.forEach(function(label) {
                                                                                        label.style.border = '2px solid black'; // Reset all label borders to black
                                                                                    });
                                                                                    var labelId = 'label_' + element.value;
                                                                                    var selectedLabel = document.getElementById(labelId);
                                                                                    selectedLabel.style.border = '4px solid black'; // Set selected label border to red
                                                                                }
                                                                            </script>

                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <div class="col-auto mx-3">
                                                                                <label>
                                                                                    <input type="radio" class="d-none" name="size" id="<?php echo $size_id; ?>" value="<?php echo $size_id; ?>">

                                                                                    <label style="cursor: not-allowed; background-color: #d5d5d5; border: 2px solid black; width: 50px; border-radius: 5px;" class=" d-flex justify-content-center align-items-center" for="<?php echo $size_id; ?>"> <?php echo $size_name ?> </label>
                                                                                </label>
                                                                            </div>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                                </div>

                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-12">

                                                                <div class="col-12">
                                                                    <label for="" class=" mb-2 fs-4">

                                                                        Colours
                                                                    </label>
                                                                </div>
                                                                <div class="row">
                                                                    <?php
                                                                    $phc_rs = Database::search("SELECT * FROM `product_has_colours` WHERE `product_id`= '" . $product_data['id'] . "'");
                                                                    $phc_num = $phc_rs->num_rows;

                                                                    for ($z = 0; $z < $phc_num; $z++) {
                                                                        $phc_data = $phc_rs->fetch_assoc();

                                                                        $clr_rs = Database::search("SELECT * FROM `colours` WHERE `id`='" . $phc_data['colours_id'] . "' ");
                                                                        $clr_data = $clr_rs->fetch_assoc();
                                                                        $clr_id = $clr_data['id'];
                                                                        $clr_name = $clr_data['colour'];

                                                                        $rs = Database::search("SELECT SUM(qty) AS qty FROM product_has_size_and_color WHERE `product_id` = '" . $pid . "' AND `colours_id`='" . $clr_id . "'");
                                                                        $d = $rs->fetch_assoc();
                                                                        $qty = $d['qty'];

                                                                        if ($qty != null) {
                                                                    ?>
                                                                            <div class="col-1">
                                                                                <div class="row mb-1  mt-2">





                                                                                    <div class=" col-12 form-check">
                                                                                        <input class="form-check-input clrR" type="radio" name="color" style="border: 1px solid black;" id="<?php echo $clr_data["id"]; ?>">
                                                                                        <img src="<?php echo $clr_data["url"]  ?>" alt="" srcset="" style="width: 20px; height: 20px; border-radius: 50%; border: 1px solid black;  " class="clrI" id=" <?php echo $crl_data["id"]; ?>" />
                                                                                    </div>






                                                                                </div>



                                                                            </div>

                                                                            <script>
                                                                                function changeBorderColor1(element) {
                                                                                    var labels = document.querySelectorAll('[id^="label+"]');
                                                                                    labels.forEach(function(label) {
                                                                                        label.style.border = '2px solid black'; // Reset all label borders to black
                                                                                    });
                                                                                    var labelId = 'label+' + element.value;
                                                                                    var selectedLabel = document.getElementById(labelId);
                                                                                    selectedLabel.style.border = '4px solid black'; // Set selected label border to red
                                                                                }
                                                                            </script>

                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <!-- <div class="col-auto mx-3">
                                                                                <label>
                                                                                    <input type="radio" class="d-none" name="color" id="<?php echo $clr_id; ?>" value="<?php echo $clr_id; ?>">
                                                                                    <label style="cursor: not-allowed; background-color: #d5d5d5; border: 2px solid black; width: 50px; border-radius: 5px;" class=" d-flex justify-content-center align-items-center" for="<?php echo $clr_id; ?>"> <?php echo $clr_name ?> </label>
                                                                                </label>
                                                                            </div> -->
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                                </div>



                                                <!-- 
                                                <div class="col-12 d-flex justify-content-center align-items-center">
                                                    <div class="row mt-3 col-12 d-flex justify-content-center align-items-center mb-4">
                                                        <select name="" id="" class="col-5" style=" border-radius: 5px;">

                                                            <option value="0" class=" text-center">Select Size</option>


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

                                                                    <option value="<?php echo $size_data["id"] ?> " class=" text-center"><?php echo $size_data["size"] ?></option>


                                                                <?php
                                                                }

                                                                ?>
                                                            <?php
                                                            }

                                                            ?>





                                                        </select> &nbsp; |

                                                        &nbsp; <select name="" id="" class="col-5" style=" border-radius: 5px;">

                                                            <option value="0" class=" text-center">Select Colour</option>
                                                            <?php
                                                            $phc_rs = Database::search("SELECT * FROM `product_has_colours` WHERE `product_id`= '" . $product_data['id'] . "'");

                                                            $phc_num = $phc_rs->num_rows;


                                                            for ($z = 0; $z < $phc_num; $z++) {
                                                                $phc_data = $phc_rs->fetch_assoc();




                                                                $colour_rs = Database::search("SELECT * FROM `colours` WHERE `id`='" . $phc_data['colours_id'] . "' ");
                                                                $colour_num = $colour_rs->num_rows;

                                                                for ($a = 0; $a < $colour_num; $a++) {
                                                                    $colour_data = $colour_rs->fetch_assoc();

                                                            ?>

                                                                    <option value="<?php echo $colour_data["id"] ?> " class=" text-center"><?php echo $colour_data["colour"] ?></option>


                                                                <?php
                                                                }

                                                                ?>
                                                            <?php
                                                            }

                                                            ?>



                                                        </select>
                                                    </div>

                                                </div> -->


                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12 d-flex align-items-center">
                                                                            <span class="me-2">Quantity:</span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" value="1" id="qty_input" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">

                                                                        <h3>Product Details</h3>

                                                                        <?php

                                                                        echo $product_data["description"];

                                                                        ?>

                                                                    </div>




                                                                    <div class="row">
                                                                        <div class="col-12 ">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class=" btn" style="background-color: black; color: white; " type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid ?>);">Buy Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class=" btn" style="background-color: white; color: black; " onclick="addToCart(<?php echo $pid ?>);">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class=" btn" style="background-color: darkgrey; color: white; " onclick="addToWatchlist(<?php echo $product_data['id'] ?>)">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row g-2">
                                    <div class="col-12 gap-5">

                                        <div class="row g-2 justify-content-center">
                                            <?php
                                            $product1_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' AND `catogary_id`='" . $product_data["catogary_id"] . "' ORDER BY `date_time` DESC LIMIT 6 OFFSET 0");
                                            $product1_num = $product1_rs->num_rows;

                                            for ($z = 0; $z < $product1_num; $z++) {
                                                $product1_data = $product1_rs->fetch_assoc();
                                            ?>
                                                <div class="col-4 col-lg-2 gap-4">
                                                    <div class="product-card">
                                                        <figure class="card-banner">
                                                            <?php
                                                            $image1_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product1_data["id"] . "'");
                                                            $image1_data = $image1_rs->fetch_assoc();
                                                            ?>

                                                            <img src="<?php echo $image1_data["url"]; ?>" style="width: 300px; height:400px;" class="w-100" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">


                                                            <!-- <div class="card-badge red"> -25%</div> -->

                                                            <div class="card-actions">
                                                                <button class="card-action-btn" aria-label="Quick view">
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product1_data["id"]); ?>' style="color: black;"><ion-icon name="eye-outline"></ion-icon></a>
                                                                </button>

                                                                <button class="card-action-btn cart-btn">
                                                                    <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                                                                    <p class="mt-3" style="margin-left: -5px;" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">Add to Cart</p>
                                                                </button>

                                                                <button class="card-action-btn" aria-label="Add to Wishlist" onclick="addToWatchlist(<?php echo $product_data['id'] ?>)">
                                                                    <ion-icon name="heart-outline"></ion-icon>
                                                                </button>
                                                            </div>
                                                        </figure>

                                                        <div class="card-content">
                                                            <h3 class="h4 card-title">
                                                                <a href="#"><?php echo $product1_data["title"]; ?></a>
                                                            </h3>

                                                            <div class="card-price">
                                                                <data value="">USD <?php echo $product1_data["price"] ?></data>

                                                                <?php
                                                                $price = $product1_data["price"];
                                                                $addttion = $price * 0.1;
                                                                $fakePrice = $price + $addttion;
                                                                ?>
                                                                <data value="">USD <?php echo $fakePrice ?></data>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <script src="bootstrap.bundle.js"></script>

                <!-- <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script> -->



                <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


                <script src="script.js"></script>


                <!-- 
    - custom js link
  -->
                <script src="./assets/js/script.js"></script>

                <!-- 
- ionicon link
-->
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


        </body>

        </html>


<?php

    } else {
        echo ("Sory for the inconvinient");
    }
} else {
    echo ("Something went wrong");
}

?>