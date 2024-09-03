<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            session_start();
            require "connection.php";

            if (isset($_SESSION["u"])) {

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-6">
                                    <label class="form-label fs-1 fw-bolder">My wish list</label>
                                </div>

                                <div class="col-6 text-end">

                                <label for="" class="mt-3" ><a href="home.php" class="fw-bold fs-5 mx-5  text-decoration-none text-black">Go to Home</a></label>
                                
                                </div>

                             

                                <div class="col-12">
                                    <hr />
                                </div>

                           

                                <?php

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet....</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-outline-dark fs-3 fw-bold">Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watch_num; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();
                                            ?>

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $img = array();

                                                            $images_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $watch_data["product_id"] . "'");
                                                            $images_data = $images_rs->fetch_assoc();

                                                            ?>
                                                            <img src="<?php echo $images_data["url"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <?php

                                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                ?>
                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $product_data["title"]; ?></h5>
                                                         
                                                     
                                                                <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">USD <?php echo $product_data["price"]; ?> .00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"]; ?> Items available</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a href="#" class="btn btn-dark mb-2" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">Buy Now</a>
                                                                <a href="#" class="btn btn-secondary mb-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</a>
                                                                <a href="#" class="btn btn-outline-dark" onclick='removeFromWatchlist(<?php echo $watch_data["id"]; ?>);'>Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }

                                        ?>





                                        </div>
                                    </div>
                                    <!-- have products -->


                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                header("Location:index.php");
            }

            ?>

            

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>