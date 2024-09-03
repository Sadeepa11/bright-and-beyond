<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Bright and Beyond | Admins</title>
</head>

<body class="container-fluid">

    <div class=" vh-100 ">
        <div class="row">

            <div class="col-12 col-lg-6 col-md-6 col -xl-6 col-xxl-6 vh-100  d-flex justify-content-center align-items-center" style="background-color: black;">

                <img src="src/logo/logo.png" alt="">
                <div class="col-6 fixed-bottom d-none d-lg-block ">
                    <p class="text-center text-light">&copy; 2024 Bright and Beyond || All Rights Reserved</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-6 col -xl-6 col-xxl-6 bg-light  d-flex justify-content-center align-items-center">

                <div class="col-12 d-flex justify-content-center align-items-center">

                    <div class="row col-12 mb-3 ">

                        <div class="col-12 text-center mb-5">

                            <h1 class="nameh1">Bright and Beyond</h1>
                            <hr>

                        </div>


                        <div class=" offset-1  col-10  d-flex justify-content-center align-items-center logInBox p-3" id="logInBox">
                            <div class="row col-12 d-flex justify-content-center align-items-center">

                                <h2>Admin Log In</h2>

                                <div class="col-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="" id="adminLogEmail" />
                                </div>

                                <div class="col-12">
                                    <label>Verification Code</label>
                                    <input type="text" class="form-control" name="" id="adminLogVCode" />
                                </div>


                                <div class="col-6 mt-3">
                                    <button type="submit" class=" col-12 btn btn-dark fw-bold fs-6" onclick="adminLogIn();">Log In</button>
                                </div>
                                <div class="col-6 mt-3">
                                    <button type="submit" class=" col-12 btn btn-secondary fw-bold fs-6" onclick="adminVcode();">Get Verification Code</button>
                                </div>






                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>