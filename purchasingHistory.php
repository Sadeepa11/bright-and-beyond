<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {


    $umail = $_SESSION["u"]["email"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bright and Beyond</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body>

        <div class="container-fluid col-12 bg-white">

            <div class="row">
                <div class="col-12">

                    <div class="col-12 mx-3 my-3">
                        <div class="row">
                            <div class="col-6">
                                <Label class="form-label fw-bolder fs-2">Purchasing History</label>

                                <p>Check the status of recent orders, manage returns, and download invoices.</p>
                            </div>
                            <div class="col-4">

                                <input type="text" class=" form-control fs-6" id="phtxt" placeholder="Invoice Id..." onkeyup="purchasingInvoiceId();" />
                            </div>

                            <div class="  col-2 pt-2">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Purchasing History</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>


                    </div>

                    <div class="col-12 text-center" id="purchasingHistoryDiv">

                        <?php

                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "' ORDER BY `date` DESC ");

                        $invoice_num = $invoice_rs->num_rows;

                        for ($z = 0; $z < $invoice_num; $z++) {
                            $invoice_data = $invoice_rs->fetch_assoc();

                        ?>

                            <div class=" card bg-white  border-1  mt-3" id="card">

                                <div class="row p-5">

                                    <div class="col-12 bg-light  p-3" style=" border-radius: 5px; ">
                                        <div class="row ">
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label class="fw-bold ">Date: <?php echo $invoice_data["date"] ?></label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label class="fw-bold">Invoice Id: <?php echo $invoice_data["id"] ?></label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label class="fw-bold">Total: USD<?php echo $invoice_data["total"] ?>.00</label>
                                            </div>
                                           

                                        </div>

                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-1">
                                                <label>#</label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label>Product</label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label>Quantity</label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label>Price</label>
                                            </div>
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center">
                                                <label>Info</label>
                                            </div>
                                        </div>

                                    </div>

                                    <?php

                                    $ihp_rs = Database::search("SELECT * FROM `invoice_has_product` WHERE `invoice_id`='" . $invoice_data["id"] . "'");

                                    $ihp_num = $ihp_rs->num_rows;

                                    for ($y = 0; $y < $ihp_num; $y++) {
                                        $ihp_data = $ihp_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $ihp_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $ihp_data["product_id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                    ?>



                                        <div class=" bg-white  border-top  mt-1">

                                            <div class="row">
                                                <div class="col-1 mt-3">
                                                    <img src="<?php echo $image_data["url"] ?>" alt="" srcset="" style="width: 100%; height: 10vh;">
                                                </div>

                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <label><?php echo $product_data["title"] ?></label>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <label><?php echo $ihp_data["get_qty"] ?></label>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <label>USD <?php echo $product_data["price"] ?>.00</label>
                                                </div>



                                                <?php
                                                if ($ihp_data["status"] == 0) {
                                                ?>

                                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                                        <label>Confirm Order</label>
                                                    </div>


                                                <?php
                                                } else if ($ihp_data["status"] == 1) {
                                                ?>

                                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                                        <label>Packing</label>
                                                    </div>

                                                <?php
                                                } else if ($ihp_data["status"] == 2) {
                                                ?>

                                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                                        <label>Dispatch</label>
                                                    </div>

                                                <?php
                                                } else if ($ihp_data["status"] == 3) {
                                                ?>

                                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                                        <label>Shipping</label>
                                                    </div>

                                                <?php
                                                } else if ($ihp_data["status"] == 4) {
                                                ?>

                                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                                        <label>Delivered</label>
                                                    </div>

                                                <?php
                                                }
                                                ?>





                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <a href="singleProductView.php?id=<?php echo $product_data['id']; ?>" class="text-decoration-none">View Product</a>
                                                </div>
                                            </div>

                                        </div>

                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>

                        <?php

                        }

                        ?>

                    </div>




                </div>

            </div>


            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php

} else {

    header("Location:index.php");
}

?>