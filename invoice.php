<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
</head>

<body>

    <?php

    require "connection.php";
    session_start();

    $oid = $_GET["id"];
    $umail = $_SESSION["u"]["email"];





    $rs = Database::search("SELECT * FROM `user`
INNER JOIN `user_has_addres` ON `user`.`email` = `user_has_addres`.`user_email`
INNER JOIN `invoice` ON `user`.`email` = `invoice`.`user_email` AND `invoice`.`order_id`='" . $oid . "'
WHERE `user`.`email` = '" . $umail . "'");
    $data = $rs->fetch_assoc();





    ?>

    <div class="container-fluid" id="page">
        <div class="row ">
            <div class="col-12 d-flex justify-content-center align-items-center ">
                <h1>Invoice</h1>
            </div>
            <div class="col-12 ">
                <div class="row">
                    <div class="col-4  text-start">
                        <span><?php echo $data["line 1"]?>,<?php echo $data["line 2"] ?></span><br />
                        <span><?php echo $data["mobile"] ?></span><br />
                        <span><?php echo $umail ?></span>
                    </div>

                    <div class="col-4  text-center">
                        <span>Maradana, Colombo 10, Sri Lanka.</span><br />
                        <span>+94 112 555448</span><br />
                        <span>brightandbeyond@gmail.com</span>
                    </div>

                    <div class="col-4  text-end">
                        <h3 class="text-primary">Id: <?php echo $data["order_id"] ?></h3>
                        <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                        <span class="fw-bold"><?php echo $data["date"] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row mt-5 p-1 fw-bold fs-4 text-center bg-primary ">
                    <div class="col-3">Item</div>
                    <div class="col-3">Unit Price</div>
                    <div class="col-3"> Quatity</div>
                    <div class="col-3">Price</div>
                </div>

                <?php

                $rs1 = Database::search("SELECT * FROM `invoice` INNER JOIN `invoice_has_product` ON `invoice`.`id` = `invoice_has_product`.`invoice_id`
                 INNER JOIN `product` ON `product`.`id`=`invoice_has_product`.`product_id` WHERE `invoice`.`order_id`= '" . $oid . "'");

                $num1 = $rs1->num_rows;

                for ($y = 0; $y < $num1; $y++) {
                    $data1 = $rs1->fetch_assoc();

                ?>


                    <div class="row mt-2 text-center">
                        <div class="col-3"> <?php echo $data1["title"] ?> </div>
                        <div class="col-3"> USD <?php echo $data1["price"] ?></div>
                        <div class="col-3"> <?php echo $data1["get_qty"] ?></div>
                        <div class="col-3"> USD <?php echo $data1["total"] ?></div>
                        <hr>
                    </div>


                <?php

                }

                ?>





            </div>
            <div class="col-12">

                <div class="row mt-5 text-center">
                    <div class=" fs-2 fw-bold col-6">Total</div>
                    <div class=" fs-6 fw-bold text-success col-3">Delivery Cost : USD <?php echo $data1["delivary_fee_colombo"]  ?></div>
                    <div class="col-3 fs-2 fw-bold" style="border-bottom: 2px black; border-bottom-style: double ;">USD <?php echo $data1["total"] ?></div>

                </div>
            </div>

            <div class="col-12 text-center mt-3">
                <label class="form-label fs-5 text-danger fw-bold">
                    **Invoice was created on a computer and is valid without the Signature and Seal**
                </label>
            </div>
            












        </div>

    </div>

    <div class="col-12 btn-toolbar justify-content-end">
                <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill" ></i> Print</button>
            </div>

    </div>
    <script src="script.js"></script>
</body>

</html>