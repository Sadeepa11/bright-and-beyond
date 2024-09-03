<?php

require "connection.php";



if (isset($_GET["e"])) {

    $admin_email = $_GET["e"];
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/css/uikit.min.css" />

        <title>Admin Panel</title>


    </head>

    <body class=" d-flex justify-content-center alig align-items-center vh-100">

        <div class="col-12 container-fluid bg-white vh-100">



            <div class="row">
                <div class=" col-lg-2 col-xl-2 col-xxl-2  vh-100 d-none d-lg-block d-xl-block d-xxl-block d-md-none bg-black">
                    <div class="row">
                        <div class="img">
                            <img src="src/logo/logo.png" alt="" width="100%">
                            <div class="col-12">
                                <div class="row text-center gap-3 ">
                                    <label class="label3 active" style=" font-family: grapeNuts; font-size: 30px;">Bright And Beyond</label>
                                    <hr width="100%" class="border-2 border-white">

                                    <label class="label2" onclick="window.location='manageProducts.php'">Manege Products</label>
                                    <hr width="100%" class="border-2 border-white">
                                    <label class="label3">Today Sellings</label>
                                    <?php

                                    $f = 0;

                                    $ihp_rs = Database::search("SELECT * FROM `invoice_has_product`");
                                    $ihp_num = $ihp_rs->num_rows;

                                    for ($x = 0; $x < $ihp_num; $x++) {
                                        $ihp_data = $ihp_rs->fetch_assoc();
                                        $f += $ihp_data["get_qty"];
                                    }
                                    ?>

                                    <label class="form-label text-white fs-2"><?php echo $f ?> Items</label>
                                    <hr width="100%" class="border-2 border-white">
                                    <label class="label2 mb-3" onclick="window.location='sellingHistory.php';">Selling History</label>
                                    <hr width="100%" class="border-2 border-white"><br>

                                </div>


                                <div class="row text-center  fs-5 text-danger">
                                    <label class="logout">Log Out</label>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-10 col-xl-10 col-xxl-10  vh-100 bg-white text-center">
                    <div class="row">

                        <div class="col-12">
                            <!-- Nav -->
                            <nav class="navbar ">
                                <div class="col-12 container-fluid bg-light">
                                    <span class="navbar-brand" style="font-size: 35px; font-weight: bold;">Admin Panel</span>
                                    <!-- Small -->
                                    <button class="navbar-toggler  d-sm-block d-lg-none d-xl-none d-xxl-none d-md-block " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                                        <div class="offcanvas-header bg-black">
                                            <h5 class="offcanvas-title label3 " style=" font-family: grapeNuts; font-size: 40px; margin-left: 10%;" id="offcanvasNavbarLabel">Bright And Beyond</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

                                        </div>

                                        <!-- <hr width="90%" style="margin-left: 5%;"> <br> -->
                                        <div class="offcanvas-body bg-black">

                                            <div class="row text-center gap-2 ">

                                                <label class="label2" onclick="window.location='manageProducts.php'">Manege Products</label>
                                                <hr width="100%" class="border-2 border-white">
                                                <label class="label3">Today Sellings</label>
                                                <?php
                                                $f = 0;

                                                $ihp_rs = Database::search("SELECT * FROM `invoice_has_product`");
                                                $ihp_num = $ihp_rs->num_rows;

                                                for ($x = 0; $x < $ihp_num; $x++) {
                                                    $ihp_data = $ihp_rs->fetch_assoc();
                                                    $f += $ihp_data["get_qty"];
                                                }
                                                ?>
                                                <label class="form-label text-white fs-2"><?php echo $f ?> Items</label>
                                                <hr width="100%" class="border-2 border-white">
                                                <label class="label2 mb-3" onclick="window.location='sellingHistory.php';">Selling History</label>
                                                <hr width="100%" class="border-2 border-white"><br>

                                            </div>


                                            <div class="row text-center mt-3 fs-5 text-danger">
                                                <label class="logout">Log Out</label>

                                            </div>



                                        </div>
                                    </div>
                                    <!-- Small -->
                                </div>
                            </nav>
                            <!-- Nav -->

                            <div class="col-12">
                                <hr width="100%" class="border-2 border-black">

                                <div class="row gap-4 d-flex justify-content-center align-items-center ">

                                    <div class="col-5 bg-light rounded-4 shadow Box">
                                        <div class="row">
                                            <span class="fs-5 fw-bold">Today Income</span>

                                            <?php
                                            $today = date("Y-m-d");
                                            $a = 0;
                                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE date LIKE '$today%'");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();
                                                $a = $invoice_data["total"]; // Accumulate total amounts
                                            }
                                            ?>

                                            <span class=" fs-5 fw-bolder txtColour">USD <?php echo $a; ?></span>
                                        </div>


                                    </div>
                                    <div class="col-5 bg-light rounded-4 shadow Box">
                                        <div class="row">
                                            <span class="fs-5 fw-bold">Monthly Income</span>

                                            <?php

                                            $thismonth = date("m");
                                            $thisyear = date("Y");
                                            $b = 0;

                                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE MONTH(date) = $thismonth AND YEAR(date) = $thisyear");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();
                                                $b += $invoice_data["total"];
                                            }


                                            ?>

                                            <span class=" fs-5 fw-bolder txtColour">USD <?php echo $b; ?></span>
                                        </div>


                                    </div>
                                    <div class="col-5 bg-light rounded-4 shadow Box">
                                        <div class="row">
                                            <span class="fs-5 fw-bold">Today Sellings</span>
                                            <?php
                                            $today = date("Y-m-d");
                                            $c = 0;

                                            $ihp_rs = Database::search("SELECT * FROM `invoice_has_product`");
                                            $ihp_num = $ihp_rs->num_rows;

                                            for ($x = 0; $x < $ihp_num; $x++) {
                                                $ihp_data = $ihp_rs->fetch_assoc();

                                                // Get the invoice date from invoice_has_product
                                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE id = {$ihp_data['invoice_id']}");
                                                $invoice_data = $invoice_rs->fetch_assoc();
                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d);
                                                $pdate = $splitDate[0]; // Sold date

                                                // Calculate total sales for today
                                                if ($pdate == $today) {
                                                    $c += $ihp_data["get_qty"];
                                                }
                                            }
                                            ?>

                                            <span class="fs-5 fw-bolder txtColour"><?php echo $c; ?> Items</span>
                                        </div>


                                    </div>
                                    <div class="col-5 bg-light rounded-4 shadow Box">

                                        <div class="row">
                                            <span class="fs-5 fw-bold">Monthly Sellings</span>

                                            <?php
                                            $thismonth = date("m");
                                            $thisyear = date("Y");
                                            $e = 0;

                                            $ihp_rs = Database::search("SELECT * FROM `invoice_has_product`");
                                            $ihp_num = $ihp_rs->num_rows;

                                            for ($x = 0; $x < $ihp_num; $x++) {
                                                $ihp_data = $ihp_rs->fetch_assoc();

                                                // Get the invoice date from invoice_has_product
                                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE id = {$ihp_data['invoice_id']}");
                                                $invoice_data = $invoice_rs->fetch_assoc();
                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d);
                                                $pdate = $splitDate[0]; // Sold date

                                                // Calculate total sales for this month
                                                $splitMonth = explode("-", $pdate);
                                                $pyear = $splitMonth[0];
                                                $pmonth = $splitMonth[1];

                                                if ($pyear == $thisyear && $pmonth == $thismonth) {
                                                    $e += $ihp_data["get_qty"];
                                                }
                                            }
                                            ?>
                                            <span class=" fs-5 fw-bolder txtColour"><?php echo $e; ?> Items</span>
                                        </div>


                                    </div>
                                    <div class="col-5 bg-light rounded-4 shadow Box">
                                        <div class="row">
                                            <span class="fs-5 fw-bold">Total Sellings</span>

                                            <?php
                                            $f = 0;

                                            $ihp_rs = Database::search("SELECT * FROM `invoice_has_product`");
                                            $ihp_num = $ihp_rs->num_rows;

                                            for ($x = 0; $x < $ihp_num; $x++) {
                                                $ihp_data = $ihp_rs->fetch_assoc();
                                                $f += $ihp_data["get_qty"];
                                            }
                                            ?>
                                            <span class=" fs-5 fw-bolder txtColour"><?php echo $f; ?> Items</span>
                                        </div>



                                    </div>
                                    <div class="col-5 bg-light rounded-4 shadow Box">
                                        <div class="row">
                                            <span class="fs-5 fw-bold">Total Engagements</span>
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5 fw-bolder txtColour"><?php echo $user_num; ?> Members</span>
                                        </div>


                                    </div>

                                </div>

                            </div>
                            <div class="col-12">
                                <hr width="100%" class="border-2 border-black">

                                <div class="row gap-5 d-flex justify-content-center align-items-center mt-4">





                                    <?php

                                    $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` 
FROM `invoice_has_product`  GROUP BY `product_id` ORDER BY 
`value_occurence` DESC LIMIT 1");

                                    $freq_num = $freq_rs->num_rows;
                                    if ($freq_num > 0) {
                                        $freq_data = $freq_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();


                                        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                        $qty_rs = Database::search("SELECT SUM(`get_qty`) AS `qty_total` FROM `invoice_has_product` WHERE 
    `product_id`='" . $freq_data["product_id"] . "' ");
                                        $qty_data = $qty_rs->fetch_assoc();

                                    ?>





                                        <div class="card mb-3 col-11">
                                            <div class="row g-0">

                                                <span class="fs-5 fw-bold text-bg-black p-3">Best Selling Item</span>
                                                <div class="col-md-4">
                                                    <img src="<?php echo $image_data["url"] ?>" class="img-fluid rounded-start" alt="..." style="max-height: 40vh;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h1 class="card-title"><?php echo $product_data["title"] ?></h1>
                                                        <p class="card-text">USD <?php echo $product_data["price"] ?></p>
                                                        <button class=" btn btn-outline-dark" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">View Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    } else { ?>

                                        <div class="card mb-3 col-11">
                                            <div class="row g-0">

                                                <span class="fs-5 fw-bold text-bg-black p-3">Best Selling Item</span>
                                                <div class="col-md-4">
                                                    <img src="src/logo/logo.png" class="img-fluid rounded-start" alt="..." style="max-height: 40vh;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h1 class="card-title">Product</h1>
                                                        <p class="card-text">USD -------</p>
                                                        <button class=" btn btn-outline-dark" onclick="window.location.href = '#'">View Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    }
                                    ?>
                                </div>

                            </div>


                        </div>

                    </div>





                </div>
            </div>



        </div>




        <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/js/uikit-icons.min.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>


<?php
} else {

    header("Location:adminLogIn.php");
}


?>