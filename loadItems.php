<?php

require "connection.php";

if (isset($_GET["c"])) {

    $category_id = $_GET["c"];

    $category_rs = Database::search("SELECT * FROM `catogary_has_item` WHERE `catogary_id`='" . $category_id . "'");
    $category_num = $category_rs->num_rows;

    for ($x = 0; $x < $category_num; $x++) {

        $category_data = $category_rs->fetch_assoc();

        $item_rs = Database::search("SELECT * FROM `item` WHERE `id`='" . $category_data["item_id"] . "'");

        $item_data = $item_rs->fetch_assoc();

?>

        <option value="<?php echo $item_data["id"]; ?>"><?php echo $item_data["name"]; ?></option>

<?php

    }
}

?>