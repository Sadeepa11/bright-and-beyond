<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="icon" href="src/logo//logo.png">
    <title>Bright and Beyond</title>
</head>

<body class="container-fluid">

    <div class=" vh-100 ">
        <div class="row">

            <!-- <div class=" d-xl-6 d-lg-6 d-md-6 d-sm-none vh-100  d-flex justify-content-center align-items-center" style="background-color: black;">

                <img src="src/logo/logo.png" alt="">
                <div class="col-6 fixed-bottom d-none d-lg-block ">
                    <p class="text-center text-light">&copy; 2024 Bright and Beyond || All Rights Reserved</p>
                </div>
            </div> -->
            <div class=" offset-3 col-6  mt-5  d-flex justify-content-center align-items-center">

                <div class="col-12 d-flex justify-content-center align-items-center">

                    <div class="row col-12 ">

                        <div class="col-12 text-center mb-5">

                            <h1 class="nameh1">Bright and Beyond</h1>
                            <hr>

                        </div>


                        <div class=" offset-1  col-10  d-flex justify-content-center align-items-center logInBox p-3" id="logInBox">
                            <div class="row d-flex justify-content-center align-items-center">

                                <h2>Log In</h2>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control col-12" id="logEmail">
                                    </div>

                                    <div class="col-12">
                                        <label>Password</label>
                                        <input type="Password" class="form-control col-12" id="logPw">
                                    </div>



                                </div>

                                <div class="col-12 p-3">
                                    <div class="row">
                                        <div class="col-6 text-start">
                                            <input type="checkbox" name="" id="rememberMe">
                                            <label>Remember Me</label>
                                        </div>
                                        <div class="col-6 text-end">
                                            <label class="fplabel" onclick="forgotPassword();">Fogot Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class=" col-12 btn btn-dark fw-bold fs-6" onclick="logIn();">Log In</button>
                                </div>

                                <div class="col-12  d-flex justify-content-center align-items-center">
                                    <label class="fs-6 formChanger" onclick="formChange();">Do not have an Account? Register.</label>
                                </div>

                            </div>


                        </div>


                        <div class=" d-none offset-1  col-10  d-flex justify-content-center align-items-center regBox p-3" id="regBox">
                            <div class="row d-flex justify-content-center align-items-center">

                                <h2>Register</h2>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control col-12" id="fname">
                                    </div>


                                    <div class="col-6">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control col-12" id="lname">
                                    </div>


                                    <div class="col-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control col-12" id="regEmail">
                                    </div>
                                    <div class="col-6">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control col-12" id="regMobile">
                                    </div>

                                    <div class="col-6">
                                        <label>Password</label>
                                        <input type="Password" class="form-control col-12" id="regPw">
                                    </div>

                                    <div class="col-6">
                                        <label>Re-Password</label>
                                        <input type="Password" class="form-control col-12" id="regRePw">
                                    </div>



                                </div>
                                <div class="col-12">
                                    <button type="submit" class=" btn btn-dark fw-bold fs-6 mt-3 col-12" onclick="reg();">Register</button>

                                </div>

                                <div class="col-12  d-flex justify-content-center align-items-center">
                                    <label class="fs-6 formChanger" onclick="formChange();">Already have an Account? Log In.</label>
                                </div>

                            </div>


                        </div>







                    </div>

                </div>

                <div class="col-6 fixed-bottom d-none d-lg-block ">
                    <p class="text-center text-light">&copy; 2024 Bright and Beyond || All Rights Reserved</p>
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