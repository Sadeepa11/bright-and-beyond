<?php

require "connection.php";

session_start();


if (isset($_GET["id"])) {
    $invoice_id = $_GET["id"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $invoice_id . "' ");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 1) {

        $invoice_data = $invoice_rs->fetch_assoc();

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $invoice_id . "' ");
        $invoice_num = $invoice_rs->num_rows;


        for ($z = 0; $z < $invoice_num; $z++) {
            $invoice_data = $invoice_rs->fetch_assoc();

?>

            <div class=" card bg-white  border-1  mt-3">

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
                                <label class="fw-bold">Total: Rs.<?php echo $invoice_data["total"] ?>/=</label>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-center">
                                <button class="invoiceBtn"> View Invoice</button>
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
                                    <label><?php echo $ihp_data["qty"] ?></label>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <label>Rs: <?php echo $product_data["price"] ?>/=</label>
                                </div>



                                <div class="col-3 d-flex justify-content-center align-items-center">

                                    <?php
                                    if ($ihp_data["status"] == 0) {
                                    ?>
                                        <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $ihp_data['id']; ?>');" id="btn<?php echo $selected_data["id"]; ?>">Confirm Order</button>
                                    <?php
                                    } else if ($ihp_data["status"] == 1) {
                                    ?>
                                        <button class="btn btn-warning fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $ihp_data['id']; ?>');" id="btn<?php echo $ihp_data["id"]; ?>">Packing</button>
                                    <?php
                                    } else if ($ihp_data["status"] == 2) {
                                    ?>
                                        <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $ihp_data['id']; ?>');" id="btn<?php echo $ihp_data["id"]; ?>">Dispatch</button>
                                    <?php
                                    } else if ($ihp_data["status"] == 3) {
                                    ?>
                                        <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeInvoiceStatus('<?php echo $ihp_data['id']; ?>');" id="btn<?php echo $ihp_data["id"]; ?>">Shipping</button>
                                    <?php
                                    } else if ($ihp_data["status"] == 4) {
                                    ?>
                                        <button class="btn btn-danger fw-bold mt-1 mb-1 disabled" onclick="changeInvoiceStatus('<?php echo $ihp_data['id']; ?>');" id="btn<?php echo $ihp_data["id"]; ?>">Delivered</button>
                                    <?php
                                    }
                                    ?>


                                </div>





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
    <?php

    } else {
    ?>

        <h1 style="font-style: italic;">No Result for '<?php echo $invoice_id ?>'</h1>
<?php
    }
}

?>