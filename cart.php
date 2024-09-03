<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtal = 0;
    $shipping = 0;
    $shipping1 = 0;

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cart|Bright & Beyond </title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.svg" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">


                <!-- <div class="col-12 pt-2" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div> -->

                <div class="col-12">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label fs-1 fw-bold">My Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                            <a  class=" offset-9 text-decoration-none text-black fs-5 fw-bold" href="home.php">Go to home</a>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no added anythings to cart....
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-outline-dark fs-3 fw-bold">
                                            Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php

                        } else {
                        ?>

                            <!-- products -->

                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_addres` INNER JOIN `city` ON 
                                        user_has_addres.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE 
                                        `user_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        // if ($address_data["did"] == 2) {
                                        $ship = $product_data["delivary_fee_colombo"];
                                        $shipping1 = $shipping1 + $product_data["delivary_fee_colombo"];
                                       

                             
                                        


                                        $shipping=$shipping1/$cart_num;

                                        // } else {
                                        //     $ship = $product_data["delivary_fee_other"];
                                        //     $shipping = $shipping + $product_data["delivary_fee_other"];
                                        // }



                                    ?>

                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">


                                                <hr>

                                                <div class="col-md-4">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus">
                                                        <img src="<?php echo $img_data["url"] ?>" class="img-fluid rounded-start" style="width: 350px; height: 300px;">
                                                    </span>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                        <?php

                                                        $size_rs = Database::search("SELECT * FROM `sizes` WHERE `id`='" . $cart_data["sizes_id"] . "'");
                                                        $size_data = $size_rs->fetch_assoc();

                                                        ?>


                                                        <label for=""><?php echo $size_data["size"] ?></label>

                                                        <!-- <select name="" id="" class="col-5" style=" border-radius: 5px;">

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





                                                        </select> -->
                                                        &nbsp; |



                                                        <?php

                                                        $clr_rs = Database::search("SELECT * FROM `colours` WHERE `id`='" . $cart_data["colours_id"] . "'");
                                                        $clr_data = $clr_rs->fetch_assoc();

                                                        ?>


                                                        <label for=""><?php echo $clr_data["colour"] ?></label>

                                                        &nbsp;

                                                        <!--  <select name="" id="" class="col-5" style=" border-radius: 5px;">

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



                                                        </select> -->
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">USD <?php echo $product_data["price"] ?></span>
                                                        <br>
                                                        <div class=" overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                                                            <div class="col-12">
                                                                <span>Quantity : </span>

                                                                <label for="">
                                                                    <?php echo $cart_data["qty"] ?>

                                                                </label>
                                                                <!-- <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="<?php echo $cart_data["qty"] ?>" onkeyup='check_value(<?php echo $product_data["id"]; ?>, <?php echo $product_data["qty"]; ?>);' id="qty_input<?php echo $product_data["id"]; ?>" />

                                                                <div class="position-absolute qty-buttons">
                                                                    <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
                                                                        <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $cart_data["id"]; ?>,<?php echo $product_data["qty"]; ?>,<?php echo $product_data["id"] ?>);'></i>
                                                                    </div>
                                                                    <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                                                        <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec(<?php echo $cart_data["id"]; ?>,<?php echo $product_data["id"] ?>);'></i>
                                                                    </div>
                                                                </div> -->

                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">USD <?php echo $ship ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">

                                                        <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    <?php }
                                    ?>

                                </div>
                            </div>

                            <!-- products -->
                            <script>

                            </script>

                             <!-- summary -->
                        <div class="col-12 col-lg-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-3 fw-bold">Summary</label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-6 mb-3">
                                    <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                </div>

                                <div class="col-6 text-end mb-3">
                                    <span class="fs-6 fw-bold">USD <?php echo $total; ?></span>
                                </div>

                                <div class="col-6">
                                    <span class="fs-6 fw-bold">Shipping</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">USD <?php echo $shipping; ?></span>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr />
                                </div>

                                <div class="col-6 mt-2">
                                    <span class="fs-4 fw-bold">Total</span>
                                </div>

                                <div class="col-6 mt-2 text-end">
                                    <span class="fs-4 fw-bold">USD <?php echo $total + $shipping; ?></span>
                                </div>

                                <div class="col-12 mt-3 mb-3 d-grid">
                                <button class="btn btn-primary fs-5 fw-bold" onclick="checkOut(<?php echo $total + $shipping; ?>, <?php echo $cart_data['id']; ?>);">CHECKOUT</button>

                                </div>

                            </div>
                        </div>
                        <!-- summary -->

                        <?php



                        }
                        ?>
                       
                        <?php
                        // }

                        ?>







                    </div>
                </div>




            </div>
        </div>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script src="./assets/js/script.js"></script>

    </body>

    </html>
<?php

} else {

    header("Location:index.php");
}

?>