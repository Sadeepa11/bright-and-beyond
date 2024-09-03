<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Fogot Password</title>
</head>

<body class=" vh-100 bg-light d-flex justify-content-center align-items-center">
    <div class="container-fluid d-flex justify-content-center align-items-center">

        <div class="row d-flex justify-content-center align-items-center">

            <h1 class="text-center p-5 fw-bolder">Fogot Password</h1>
            <div class="   col-6  d-flex justify-content-center align-items-center fpBox p-3">
                <div class="row d-flex justify-content-center align-items-center">

                    <h2>Reset Your Password</h2>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label>Verification Code</label>
                            <input type="text" class="form-control col-12" id="vCode">
                        </div>


                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" class="form-control col-12" id="fpEmail">
                        </div>
                       
                        <div class="col-6">
                            <label>New Password</label>
                            <input type="Password" class="form-control col-12" id="NewPw">
                        </div>

                        <div class="col-6">
                            <label>Re-type New Password</label>
                            <input type="Password" class="form-control col-12" id="NewRePw">
                        </div>



                    </div>
                    <div class="col-12">
                        <button type="submit" class=" btn btn-dark fw-bold fs-6 mt-3 col-12" onclick="resetPassword();">Reset Password</button>

                    </div>


                </div>


            </div>


        </div>

    </div>




    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>