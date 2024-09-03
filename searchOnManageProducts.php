<?php

require "connection.php";

$txt = $_POST["txt"];
// $item = $_POST["item_id"];



$query = "SELECT * FROM `product`  WHERE `title` LIKE '%" . $txt . "%'";

if (!empty($txt) && $item == null) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $item != 0) {
    $query .= " WHERE `item_id`='" . $item . "'";
} else if (!empty($txt) && $item != 0) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' AND `item_id`='" . $item . "'";
}




?>

<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">

        <?php

        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }

        $product_rs = Database::search($query);
     
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
                            <span class="card-text fw-bold text-primary">USD <?php echo $selected_data["price"]; ?> .00</span><br />
                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" onchange="blockProduct(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                <label class="form-check-label fw-bold text-info" for="fd<?php echo $selected_data["id"]; ?>">
                                    <?php if ($selected_data["status_id"] == 2) { ?> Make Your Product Active <?php
                                                                                                            } else {
                                                                                                                ?>Make Your Product Deactive<?php
                                                                                                                                        } ?>

                                </label>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1">
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-success fw-bold" onclick="viewProduct('<?php echo $selected_data['id']; ?>');">Update</button>
                                        </div>
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-danger fw-bold">Delete</button>
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