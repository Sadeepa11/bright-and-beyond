<?php
require "connection.php";

// $iid = $_POST["iid"];
$sid = $_POST["sid"];
$cid = $_POST["cid"];
$I = $_POST["I"];

$product_ids = [];

// Building the base query for product IDs
$query = "SELECT product.id FROM product";

// Join statements to include size and color filters
$join_statements = [];

if ($sid != null) {
    $join_statements[] = "INNER JOIN product_has_sizes ON product.id = product_has_sizes.product_id AND product_has_sizes.sizes_id = '" . $sid . "'";
}

if ($cid != null) {
    $join_statements[] = "INNER JOIN product_has_colours ON product.id = product_has_colours.product_id AND product_has_colours.colours_id = '" . $cid . "'";
}

// Add the join statements to the query if there are any
if (!empty($join_statements)) {
    $query .= " " . implode(" ", $join_statements);
}

$rs = Database::search($query);

// Collecting product IDs
while ($data = $rs->fetch_assoc()) {
    $product_ids[] = $data["id"];
}

// Prepare the order by clause based on the filter I
$order_by = "";
if ($I == 1) {
    $order_by = "ORDER BY `date_time` DESC";
} elseif ($I == 2) {
    $order_by = "ORDER BY `price` ASC";
} elseif ($I == 3) {
    $order_by = "ORDER BY `price` DESC";
}

// Fetch products based on collected product IDs
if (!empty($product_ids)) {
    $ids = implode(",", $product_ids);
    $p_rs = Database::search("SELECT * FROM `product` WHERE `id` IN ($ids) $order_by");
} else if ($I != 0) {
    // If there are no product IDs but there's a sort filter, apply it to all products
    $p_rs = Database::search("SELECT * FROM `product` $order_by");
} else {
    // If no filters are applied and no sort filter, return a message
    echo "Please select Colour and Size option to filter";
    exit;
}

if ($p_rs) {
    $product_num = $p_rs->num_rows;
?>

<ul class="product-list gap-3" id="product_list">
    <?php
    for ($z = 0; $z < $product_num; $z++) {
        $product_data = $p_rs->fetch_assoc();
        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
        $image_data = $image_rs->fetch_assoc();
    ?>
        <li>
            <div class="product-card">
                <figure class="card-banner">
                    <img src="<?php echo $image_data["url"]; ?>" style="width: 100%; height:400px;" class="" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">
                    <div class="card-actions">
                        <button class="card-action-btn" aria-label="Quick view">
                            <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' style="color: black;"><ion-icon name="eye-outline" onclick="singleProduct();"></ion-icon></a>
                        </button>
                        <button class="card-action-btn cart-btn" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">
                            <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
                            <p>Add to Cart</p>
                        </button>
                        <button class="card-action-btn" aria-label="Add to Wishlist">
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
                        $addition = $price * 0.1;
                        $fakePrice = $price + $addition;
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

<?php
} else {
    echo "No products found.";
}
?>



