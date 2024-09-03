<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Bright & Beyond</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo.svg" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            require "connection.php";
            session_start();
            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];
                $details_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
                $address_rs = Database::search("SELECT * FROM `user_has_addres` INNER JOIN `city` ON user_has_addres.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `user_email`='" . $email . "'");
                $details = $details_rs->fetch_assoc();
                $address_details = $address_rs->fetch_assoc();
            ?>
                <div class="col-12 ">
                    <div class="row">

                        <div class="col-12 bg-body rounded mt-3 mb-4">
                            <div class="row g-2">

                                <div class="col-12 text-center fs-1 fw-bold">
                                    <div class="row">
                                        <span>Profile Settings</span>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6 border-end">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Personal Deails</h4>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" value="<?php echo $details["fname"]; ?>" />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" value="<?php echo $details["lname"]; ?>" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control" id="mobile" value="<?php echo $details["mobile"]; ?>" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" value="<?php echo $details["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-dark" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details["email"]; ?>" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details["joined_date"]; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6 col-xl-6 col-xxl-6">
                                    <div class="row">

                                        <div class="p-3 py-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="fw-bold">Address Details</h4>
                                            </div>

                                            <?php
                                            if (!empty($address_details["line 1"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" class="form-control" id="line1" value="<?php echo $address_details["line 1"]; ?>" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" class="form-control" id="line1" />
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (!empty($address_details["line 2"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" class="form-control" id="line2" value="<?php echo $address_details["line 2"]; ?>" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" class="form-control" id="line2" />
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            ?>
                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>" <?php if (!empty($address_details["province_id"]) && $province_data["id"] == $address_details["province_id"]) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?php echo $province_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($address_details["district_id"]) && $district_data["id"] == $address_details["district_id"]) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?php echo $district_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>" <?php if (!empty($address_details["city_id"]) && $city_data["id"] == $address_details["city_id"]) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $city_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                            if (!empty($address_details["postal_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" class="form-control" id="pcode" value="<?php echo $address_details["postal_code"]; ?>" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pcode" class="form-control" />
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-dark" onclick="updateProfile();">Update My Profile</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php
            } else {
                header("Location:home.php");
            }
    ?>
    </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>