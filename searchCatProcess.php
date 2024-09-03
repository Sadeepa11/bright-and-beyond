<?php

require "connection.php";

$id = $_POST["id"];
?>

<div class="row">
<!-- ************************************** -->
<div class="col-lg-3 col-xl-3 col-xxl-3 d-lg-flex d-xl-flex d-xxl-flex d-md-flex d-sm-flex " style=" border-right: 2px solid white;">

<div class="col-12 mt-2 ">
    <div class="row">
        <div class=" offset-1 col-10">
            <div class=" row">
                <span class="fw-light">Sort By</span>
                <select name="" id="sortSelect" class="form-select">
                    <option value="0">Select Option</option>
                    <option value="1">Newest</option>
                    <option value="2">Price Low to High</option>
                    <option value="3">Price High to Low</option>

                </select>
                <button class=" d-grid mt-2 btn btn-dark" style="height: max-content;"> Clear All</button>
            </div>
        </div>
        <div class="offset-1 col-10 mt-2"  style="border-bottom: 1px solid black;">
            <span class="fw-light">Colours</span>
            <div class="row" id="sortClr">
                <?php
                $crl_rs = Database::search("SELECT * FROM `colours` LIMIT 8");
                $crl_num = $crl_rs->num_rows;

                for ($x = 0; $x < $crl_num; $x++) {
                    $crl_data = $crl_rs->fetch_assoc();
                ?>
                    <div class="col-3">
                        <div class="row mb-1  mt-2">





                            <div class=" col-12 form-check">
                                <input class="form-check-input clrR" type="radio" name=" " id="<?php echo $crl_data["id"]; ?>">
                                <img src="<?php echo $crl_data["url"]  ?>"  alt="" srcset="" style="width: 20px; height: 20px; border-radius: 50%; border: 1px solid black;  " class="clrI" id=" <?php echo $crl_data["id"]; ?>" />
                            </div>

                     




                        </div>



                    </div>
                <?php
                }
                ?>



            </div>
            <div class="col-12">
                <label style="margin-top: 1vh; margin-bottom: 1vh; font-size: 12px; font-weight: bold; cursor: pointer;" onclick="moreClr();" id="a1">+ Show More</label>
                
            </div>


        </div>

     

        <div class="offset-1 col-10 mt-2" style="border-bottom: 1px solid black;" >
            <span class="fw-light">Sizes</span>
            <div class="row" id="sortSize">

                <?php


                $size_rs = Database::search("SELECT * FROM `sizes` LIMIT 8");
                $size_num = $size_rs->num_rows;

                for ($x = 0; $x < $size_num; $x++) {
                    $size_data = $size_rs->fetch_assoc();

                ?>

                    <div class=" col-3 form-check">
                        <input class="form-check-input sizeR" type="radio" name="r1" id="<?php echo $size_data["id"]; ?>">
                        <label class="form-check-label" for="<?php echo $size_data["id"]; ?>">
                            <?php echo $size_data["size"]; ?>
                        </label>
                    </div>



                <?php
                }

                ?>

            </div>
            <div class="col-12">
            <label style="margin-top: 1vh; margin-bottom: 1vh; font-size: 12px; font-weight: bold; cursor: pointer;" onclick="moreSize();" id="a2">+ Show More</label>
                
            </div>


        </div>
        <!-- <div class="offset-1 col-10 mt-2" style="border-bottom: 1px solid black;" >
            <span class="fw-light">Items</span>
            <div class="row" id="sortItem">

                <?php


                $item_rs = Database::search("SELECT * FROM `item` LIMIT 8");
                $item_num = $item_rs->num_rows;

                for ($x = 0; $x < $item_num; $x++) {
                    $item_data = $item_rs->fetch_assoc();

                ?>

                    <div class=" form-check">
                        <input class="form-check-input itemR" type="radio" name="r3" id="<?php echo $item_data["id"]; ?>">
                        <label class="form-check-label" for="<?php echo $item_data["id"]; ?>">
                            <?php echo $item_data["name"]; ?>
                        </label>
                    </div>





                <?php
                }

                ?>

            </div>
            <div class="col-12">
            <label style="margin-top: 1vh; margin-bottom: 1vh; font-size: 12px; font-weight: bold; cursor: pointer;" onclick="moreItems();" id="a3">+ Show More</label>
                
            </div>


        </div> -->
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class=" row">
                <button class=" d-grid mt-2 btn btn-dark" style="height: max-content;" onclick="sortAdvancedSearch();">Sort</button>
            </div>
        </div>

    </div>
</div>



</div>
    <div class="col-lg-9 col-xl-9 col-xxl-9 mt-2" id="sort-sec">

        <ul class="product-list gap-3" id="product_list">




            <?php
            $product_rs = Database::search("SELECT * FROM `product` WHERE
`status_id`='1' AND `catogary_id`= '" . $id . "' ORDER BY `date_time` DESC ");

            $product_num = $product_rs->num_rows;

            for ($z = 0; $z < $product_num; $z++) {
                $product_data = $product_rs->fetch_assoc();
            ?>

                <li>
                    <div class="product-card">

                        <figure class="card-banner">
                            <?php

                            $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
                            $image_data = $image_rs->fetch_assoc();

                            ?>


                            <img src="<?php echo $image_data["url"]; ?>" style="width: 100%; height:400px;" class="" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">


                            <!-- <div class="card-badge red"> -25%</div> -->

                            <div class="card-actions">

                                <button class="card-action-btn" aria-label="Quick view">
                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' style="color: black;"><ion-icon name="eye-outline" onclick="singleProduct();"></ion-icon></a>
                                </button>

                                <button class="card-action-btn cart-btn" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">
                                    <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>

                                    <p>Add to Cart</p>
                                </button>

                                <button class="card-action-btn" aria-label="Add to Whishlist">
                                    <ion-icon name="heart-outline"></ion-icon>
                                </button>

                            </div>

                        </figure>

                        <div class="card-content">
                            <h3 class="h4 card-title">
                                <a href="#"><?php echo $product_data["title"]; ?></a>
                            </h3>

                            <div class="card-price">
                                <data value="">USD <?php echo $product_data["price"] ?>.00</data>


                                <?php

                                $price = $product_data["price"];
                                $addttion = $price * 0.1;

                                $fakePrice = $price + $addttion;

                                ?>

                                <data value="">USD <?php echo $fakePrice ?>.00</data>
                            </div>
                        </div>

                    </div>
                </li>


            <?php


            }

            ?>

        </ul>

    </div>

</div>