<?php



require "connection.php";


$pageno;

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <div class="col-12 bg-black">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 col-lg-4 mt-1 mb-1 text-center">

                                <img src="src/logo/logo.png" width="90px" height="90px" class="rounded-circle" />

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                <h1 class="offset-4 offset-lg-2 text-white fw-bold">Manage Products</h1>
                            </div>
                            <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">

                                <i class="bi bi-cloud-plus fs-1 text-white fw-bold" onclick="window.location='addProduct.php'" title="Add Products" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- header -->

            <!-- body -->
            <div class="col-12">
                <div class="row">
                    <!-- filter -->
                    <div class="col-11 col-lg-2 mx-3 my-3" style="border-right: 1px solid black;">
                        <div class="row">
                            <div class="col-12 mt-3 fs-5">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-3">Sort Products</label>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" placeholder="Search..." class="form-control" id="txt" />
                                            </div>
                                            <div class="col-1 p-1">
                                                <label class="form-label"><i class="bi bi-search fs-5" style="cursor: pointer;" onclick="searchOnManageProducts();"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fs-6 text-secondary">Active Time</label>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="n">
                                            <label class="form-check-label" for="n">
                                                Newest to oldest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="o">
                                            <label class="form-check-label" for="o">
                                                Oldest to newest
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label fs-6 text-secondary">By quantity</label>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="h">
                                            <label class="form-check-label" for="h">
                                                High to low
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="l">
                                            <label class="form-check-label" for="l">
                                                Low to high
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label fs-6 text-secondary">By Item</label>
                                    </div>


                                    <div class="col-12">




                                        <select id="item_id">
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
                                                $('#item_id').selectize({
                                                    sortField: 'text'
                                                });
                                            });
                                        </script>

                                    </div>

                                    <div class="col-12 text-center mt-3 mb-3">
                                        <div class="row g-2">
                                            <div class="col-12  d-grid">
                                                <button class="btn btn-dark fw-bold" onclick="sort1(0);">Sort</button>
                                            </div>
                                            <div class="col-12  d-grid">
                                                <button class="btn btn-secondary fw-bold" onclick="clearsort();">Clear</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter -->

                    <!-- product -->
                    <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                        <div class="row" id="sort">

                            <div class="offset-1 col-10 text-center">
                                <div class="row justify-content-center">

                                    <?php

                                    if (isset($_GET["page"])) {
                                        $pageno = $_GET["page"];
                                    } else {
                                        $pageno = 1;
                                    }

                                    $product_rs = Database::search("SELECT * FROM `product`");
                                    $product_num = $product_rs->num_rows;

                                    $results_per_page = 6;
                                    $number_of_pages = ceil($product_num / $results_per_page);

                                    $page_results = ($pageno - 1) * $results_per_page;
                                    $selected_rs =  Database::search("SELECT * FROM `product`
                                    LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                    $selected_num = $selected_rs->num_rows;

                                    for ($x = 0; $x < $selected_num; $x++) {
                                        $selected_data = $selected_rs->fetch_assoc();
                                    ?>

                                        <!-- card -->
                                        <div class="card mb-3 mt-3 col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-md-4 mt-4">
                                                    <?php

                                                    $product_img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                    $product_img_data = $product_img_rs->fetch_assoc();

                                                    ?>
                                                    <img src="<?php echo $product_img_data["url"]; ?>" class="img-fluid rounded-start" />
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                        <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                        <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" onchange="blockProduct(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                                            <label class="form-check-label fw-bold text-info" id="lfd<?php echo $selected_data["id"]; ?>">
                                                                Make Your Product Deactivate



                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row g-1">
                                                                    <div class="col-12  d-grid">
                                                                        <button class="btn btn-dark fw-bold" onclick="viewProduct('<?php echo $selected_data['id']; ?>');">Update</button>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- card -->

                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>

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
                                                <li class="page-item  bg-black">
                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="page-item bg-black">
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
                    <!-- product -->

                </div>
            </div>
            <!-- body -->

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>