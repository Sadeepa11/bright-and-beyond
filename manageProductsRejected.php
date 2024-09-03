<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


</head>

<body class=" bg-light">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage All Products</label>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0  col-12 col-12 c mb-3">
                        <div class="row">
                            <div class="col-4">




                                <select id="item_id">
                                    <option value="">Select Item</option>
                                    <?php

                                    require "connection.php";

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
                                        $('#item_id').selectize({
                                            sortField: 'text'
                                        });
                                    });
                                </script>

                            </div>

                            <div class="col-4">
                                <input type="text" class="form-control" id="txt" />
                            </div>
                            <div class="offset-2 col-1 ">
                                <i class="bi bi-search fs-2" style="cursor: pointer;" title="Search Products" onclick="searchOnManageProducts();"></i>
                            </div>
                            <div class="col-1 ">
                                <i class="bi bi-cloud-plus fs-2"  onclick="window.location='addProduct.php'" title="Add Products" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12" id="products">
                <div class="row">

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                                <span class="fs-4 fw-bold text-white">#</span>
                            </div>
                            <div class="col-2 d-none d-lg-block text-center bg-secondary py-2">
                                <span class="fs-4 fw-bold">Item</span>
                            </div>
                            <div class="col-4 col-lg-2 bg-primary py-2">
                                <span class="fs-4 fw-bold text-white">Title</span>
                            </div>
                            <div class="col-4 col-lg-2 d-lg-block bg-secondary py-2">
                                <span class="fs-4 fw-bold">Price</span>
                            </div>
                            <div class="col-2 d-none d-lg-block bg-primary py-2">
                                <span class="fs-4 fw-bold text-white">Quantity</span>
                            </div>
                            <div class="col-2 d-none d-lg-block bg-secondary py-2">
                                <span class="fs-4 fw-bold">Registered Date</span>
                            </div>
                            <div class="col-2 col-lg-1 bg-secondary"></div>
                        </div>
                    </div>

                    <?php


                    $query = "SELECT * FROM `product`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $product_rs = Database::search($query);
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 5;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                    ?>

                        <div class="col-12 mt-3 mb-3 " >
                            <div class="row"  style="cursor: pointer;">
                                <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                                    <span class="fs-4 fw-bold text-white"><?php echo $selected_data["id"]; ?></span>
                                </div>
                                <div class="col-2 d-none d-lg-block bg-secondary text-center  py-2" onclick="viewProduct('<?php echo $selected_data['id']; ?>');">
                                    <?php
                                    $item_rs = Database::search("SELECT * FROM `item` WHERE `id`='" . $selected_data["item_id"] . "'");
                                    $item_data = $item_rs->fetch_assoc();

                                    ?>
                                    <span class="fs-5 fw-bold  text-black"><?php echo $item_data["name"]; ?></span>

                                </div>
                                <div class="col-4 col-lg-2 bg-primary py-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $selected_data["title"]; ?></span>
                                </div>
                                <div class="col-4 col-lg-2 d-lg-block bg-secondary py-2">
                                    <span class="fs-4 fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</span>
                                </div>
                                <div class="col-2 d-none d-lg-block bg-primary py-2">
                                    <span class="fs-4 fw-bold text-white"><?php echo $selected_data["qty"]; ?></span>
                                </div>
                                <div class="col-2 d-none d-lg-block bg-secondary py-2">
                                    <span class="fs-5 fw-bold"><?php echo $selected_data["date_time"]; ?></span>
                                </div>
                                <div class="col-2 col-lg-1 bg-secondary py-2 d-grid">
                                    <?php

                                    if ($selected_data["status_id"] == 1) {
                                    ?>
                                        <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                    <?php

                                    }

                                    ?>
                                </div>
                            </div>
                        </div>


                    <?php

                    }

                    ?>

                    <!--  -->
                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="
                            <?php if ($pageno <= 1) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno - 1);
                            } ?>
                            " aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php

                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>

                                <li class="page-item">
                                    <a class="page-link" href="
                            <?php if ($pageno >= $number_of_pages) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno + 1);
                            } ?>
                            " aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>



                </div>
            </div>



            <!-- modal 01 -->
            <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data["id"]; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold text-success"><?php echo $selected_data["title"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="offset-4 col-4">
                                <img src="resource/mobile_images/iphone12.jpg" class="img-fluid" style="height: 150px;" />
                            </div>
                            <div class="col-12">
                                <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                <span class="fs-5">Rs. 100000 .00</span><br />
                                <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                <span class="fs-5">10 Products left</span><br />
                                <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                <span class="fs-5">Lahiru</span><br />
                                <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                <span class="fs-5">Good Product.</span><br />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 01 -->

            <!--  -->





        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>