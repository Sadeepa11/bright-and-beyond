<?php

require "connection.php";

$txt = $_POST["s"];




if (!empty($txt)) {



?>

    <section class="section product">
        <div class="container">

            <h2 class="h2 section-title">Results for "<?php echo $txt  ?>"</h2>

            
            <ul class="product-list" id="results">
                <?php

                $product_rs = Database::search("SELECT * FROM `product` WHERE
`status_id`='1' AND `title` LIKE '%" . $txt . "%' ORDER BY `date_time` DESC ");

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

                    
                                    <img src="<?php echo $image_data["url"]; ?>"  style="width: 100%; height:400px;"  class="" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">
                        

                                <!-- <div class="card-badge red"> -25%</div> -->

                                <div class="card-actions">

                                    <button class="card-action-btn" aria-label="Quick view" >
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
                                    <data value="">USD <?php echo $product_data["price"] ?></data>


                                    <?php

                                    $price = $product_data["price"];
                                    $addttion = $price * 0.1;

                                    $fakePrice = $price + $addttion;

                                    ?>

                                    <data value="">USD <?php echo $fakePrice ?></data>
                                </div>
                            </div>

                        </div>
                    </li>


                <?php


                }
                ?>

            </ul>

        </div>
    </section>
<?php


} else {

?>

    <section class="section product">
        <div class="container">

            <h2 class="h2 section-title">No results for your search ...</h2>

        
        </div>
    </section>

<?php
}

?>