function formChange() {
    var logInBox = document.getElementById("logInBox");
    var regBox = document.getElementById("regBox");

    logInBox.classList.toggle("d-none");
    regBox.classList.toggle("d-none");

}

function logIn() {
    var email = document.getElementById("logEmail");
    var password = document.getElementById("logPw");
    var rememberme = document.getElementById("rememberMe");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "home.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("POST", "signIn.php", true);
    r.send(f);

}
function reg() {

    var f = document.getElementById("fname");
    var l = document.getElementById("lname");
    var e = document.getElementById("regEmail");
    var p = document.getElementById("regPw");
    var m = document.getElementById("regMobile");
    var rp = document.getElementById("regRePw");

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("rp", rp.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                window.location.reload();
            } else {
                alert(text);
            }
        }
    }


    request.open("POST", "signUp.php", true);
    request.send(form);
}

function forgotPassword() {

    var email = document.getElementById("logEmail");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");

                window.location = "fogotPasswordUI.php";
            } else {
                alert(t);

            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();



}

function resetPassword() {

    var email = document.getElementById("fpEmail");
    var np = document.getElementById("NewPw");
    var rnp = document.getElementById("NewRePw");
    var vcode = document.getElementById("vCode");


    var f = new FormData();

    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Your Password is Updated");

                window.location = "index.php";


            } else {
                alert(t);
            }
        }

    };


    r.open("POST", "resetPassword.php", true);
    r.send(f);

}
function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                window.location.reload();

            }
        }
    };

    r.open("GET", "signoutProcess.php", true);
    r.send();
}
function adminVcode() {
    var adminEmail = document.getElementById("adminLogEmail").value;

    var f = new FormData();

    f.append("admin_email", adminEmail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;
            if (t == "Success") {

                alert("Verification Code Sent Check Your Email !!!");

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sendAdminCode.php", true);
    r.send(f);
}

function adminLogIn() {
    var adminEmail = document.getElementById("adminLogEmail").value;
    var adminLogVCode = document.getElementById("adminLogVCode").value;

    var f = new FormData();

    f.append("admin_email", adminEmail);
    f.append("admin_VCode", adminLogVCode);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;
            if (t == "Success") {

                window.location = "adminPanel.php?e=" + adminEmail;

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "verifyAdmin.php", true);
    r.send(f);
}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 6) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }

        } else {
            alert(file_count + " files. You are proceed to upload only 6 or less than 6 files.");
        }

    }

}

function addProduct() {
    var category = document.getElementById("category");
    var item = document.getElementById("item");
    var title = document.getElementById("title");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    // var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");
    var checkboxes = document.querySelectorAll('.clrCheckBoxes input[type="checkbox"]:checked');
    var checkboxes2 = document.querySelectorAll('.sizeCheckBoxes input[type="checkbox"]:checked');

    desc.value = CKEDITOR.instances.editor1.getData();

    // if (!category.value || !item.value || !title.value || !cost.value || !dwc.value || !doc.value || !desc.value || checkboxes.length === 0 || checkboxes2.length === 0) {
    //     alert("Please fill out all required fields and select at least one checkbox in each category.");
    //     return;
    // }

    var f = new FormData();
    f.append("ca", category.value);
    f.append("i", item.value);
    f.append("t", title.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    // f.append("doc", doc.value);
    f.append("desc", desc.value);

    checkboxes.forEach((checkbox) => {
        f.append("col[]", checkbox.id);
    });

    checkboxes2.forEach((checkbox) => {
        f.append("size[]", checkbox.id);
    });

    for (var x = 0; x < image.files.length; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4) {
            var t = r.responseText;

          if(t.startsWith("Error")){
            alert(t);

          }else{
            window.location = "addProductQty.php?id=" + t;

          }

          


        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}


function loadItems() {
    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("item").innerHTML = t;

        }
    }

    r.open("GET", "loadItems.php?c=" + category, true);
    r.send();

}

function addCat() {
    var cat_in = document.getElementById("cat_in").value;

    var f = new FormData();
    f.append("cat_in", cat_in);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;

            if (t = "Success") {

                alert("Category added successfully, Please pick your Category");
                window.location.reload();

            } else {

                alert(t);

            }

        } else {



        }
    }
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);

}

function addItem() {
    var item_in = document.getElementById("item_in").value;



    var f = new FormData();
    f.append("item_in", item_in);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;

            if (t = "Success") {

                alert("Item added successfully, Please pick your Item");

                window.location.reload();

            } else {

                alert(t);

            }

        } else {



        }
    }
    r.open("POST", "addNewItemProcess.php", true);
    r.send(f);

}

function addColour() {
    var clr_in = document.getElementById("clr_in").value;
    var clr_img = document.getElementById("clr_img");



    var f = new FormData();
    f.append("clr_in", clr_in);
    f.append("clr_img", clr_img.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;

            document.getElementById("clrCheckBoxes").innerHTML = t;

        } else {



        }
    }
    r.open("POST", "addNewClrProcess.php", true);
    r.send(f);

}


function addSize() {
    var size_in = document.getElementById("size_in").value;

    var f = new FormData();
    f.append("size_in", size_in);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;


            document.getElementById("sizeCheckBoxes").innerHTML = t;



        } else {



        }
    }
    r.open("POST", "addNewSizeProcess.php", true);
    r.send(f);

}
function searchOnManageProducts() {

    //    var item_id = document.getElementById("item_id").value;
    var txt = document.getElementById("txt").value;

    // alert(item_id);
    // alert(txt);

    var f = new FormData();
    // f.append("item_id", item_id);
    f.append("txt", txt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;

        } else {



        }
    }
    r.open("POST", "searchOnManageProducts.php", true);
    r.send(f);

}

function viewProduct(id) {

    window.location = "updateProduct.php?id=" + id;





}

// function blockProduct(id) {

//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function () {
//         if (request.readyState == 4) {

//             var label = 'lfd' + id;

//             var r = request.response();

//             label.innerText= r;

//             window.location.reload();
//         }
//     }

//     request.open("GET", "productBlockProcess.php?id=" + id, true);
//     request.send();

// }

function blockProduct(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) { // Added status check
            // Construct the ID and get the label element
            var labelId = 'lfd' + id;
            var label = document.getElementById(labelId);

            if (label) { // Ensure the label element exists
                // Get the response text
                var responseText = request.responseText;

                // Set the label's innerText to the response text
                label.innerText = responseText;

                // Optionally reload the page if necessary
                // window.location.reload(); // Uncomment if you really need to reload the page
            }
        }
    };

    // Open the request
    request.open("GET", "productBlockProcess.php?id=" + id, true);
    // Send the request
    request.send();
}


function updateProduct(product_id) {

    var title = document.getElementById("t").value;
    // var qty = document.getElementById("q").value;
    var dwc = document.getElementById("dwc").value;
    // var doc = document.getElementById("doc").value;
    var d = document.getElementById("d");
    var images = document.getElementById("imageuploader");
    var id = product_id;


    d.value = CKEDITOR.instances.editor1.getData();

    var f = new FormData();
    f.append("t", title);
    // f.append("q", qty);
    f.append("dwc", dwc);
    // f.append("doc", doc);
    f.append("d", d.value);
    f.append("id", id);

    var file_count = images.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);

}

function sort1(x) {




    var search = document.getElementById("txt");
    var item_id = document.getElementById("item_id").value;



    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }


    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("item_id", item_id);

    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;



            document.getElementById("sort").innerHTML = t;

        }

    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function clearsort() {
    window.location.reload();
}

function singleProduct() {
    // window.location="singleProductView.php?e="+id;
    alert("id");

}

function loadImg(id) {
    var sample_img = document.getElementById("productImg" + id).src;





    var main_img = document.getElementById("mainImg");

    main_img.src = sample_img;

}

function updateProfile() {



    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");



    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);
}


function check_value(id, qty) {
    var input = document.getElementById("qty_input" + id);

    if (input.value <= 0) {
        alert("Quantity must be 1 or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficient Quantity.");
        input.value = qty;
    }
}

function qty_inc(c_id, qty, id) {
    var input = document.getElementById("qty_input" + id);

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue;


    } else {
        alert("Maximum quantity has been achieved");
        input.value = qty;
    }


    var f = new FormData();

    f.append("qty", input.value);
    f.append("c_id", c_id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateCartQty.php", true);
    r.send(f);
}

function qty_dec(c_id, id) {
    var input = document.getElementById("qty_input" + id);

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue;


    } else {
        alert("Minimum quantity has been achieved");
        input.value = 1;
    }

    var f = new FormData();

    f.append("qty", input.value);
    f.append("c_id", c_id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateCartQty.php", true);
    r.send(f);

}

function changeInvoiceStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "btn btn-warning fw-bold mt-1 mb-1";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold mt-1 mb-1";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold mt-1 mb-1";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "btn btn-danger fw-bold mt-1 mb-1 disabled";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();

}

function searchInvoiceId() {
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("viewArea").innerHTML = t;

        }
    }

    r.open("GET", "searchInvoiceIdProcess.php?id=" + txt, true);
    r.send();
}

function findSellings() {

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET", "findSellingsProcess.php?f=" + from + "&t=" + to, true);
    r.send();

}


function payNow(id) {
    var sizeId = document.querySelector('input[name="size"]:checked').id;
    var colorId = document.querySelector('input[name="color"]:checked').id;
    var qty = document.getElementById("qty_input").value;






    var f = new FormData();
    f.append("id", id);
    f.append("sizeId", sizeId);
    f.append("colorId", colorId);
    f.append("qty", qty);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);

            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];



            if (t == 1) {
                alert("Please login.");
                window.location = "index.php";
            } else if (t == 2) {
                alert("Please Update your profile");
                window.location = "userProfile.php";
            } else if (t == 3) {
                alert("Not much stock from these selections");

            } else {


                //  Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer

                    saveInvoice(orderId, id, mail, amount, qty, sizeId, colorId);
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1226135",    // Replace your Merchant ID
                    "return_url": "http://localhost/bright and beyond/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/bright and beyond/singleProductView.php?id=" + id,     // Important
                    "notify_url": "",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "USD",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }
        }
    }

    r.open("POST", "buyNow.php", true);
    r.send(f);

}

function saveInvoice(orderId, id, mail, amount, qty, sizeId, colorId) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);
    f.append("s", sizeId);
    f.append("c", colorId);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {



                window.location = "invoice.php?id=" + orderId;

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function saveInvoiceCart(cartId, orderId, amount, mail) {
    var f = new FormData();
    f.append("cartId", cartId);
    f.append("orderId", orderId);
    f.append("amount", amount);
    f.append("mail", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {



                window.location = "invoiceCart.php?oid=" + orderId;


            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoiceCart.php", true);
    r.send(f);

}

function printInvoice() {

    // alert("Hii");
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}


function checkOut(total, cartId) {


    var f = new FormData();
    f.append("total", total);
    // f.append("sizeId", sizeId);
    // f.append("colorId", colorId);
    // f.append("qty", qty);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);

            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];



            if (t == 1) {
                alert("Please login.");
                window.location = "index.php";
            } else if (t == 2) {
                alert("Please Update your profile");
                window.location = "userProfile.php";


            } else {


                //  Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer

                    saveInvoiceCart(cartId, orderId, amount, mail);
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1226135",    // Replace your Merchant ID
                    "return_url": "http://localhost/bright and beyond/cart.php",    // Important
                    "cancel_url": "http://localhost/bright and beyond/cart.php",    // Important
                    "notify_url": "",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "USD",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "USA",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "USA",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }
        }
    }

    r.open("POST", "cartPayment.php", true);
    r.send(f);




}
function purchasingInvoiceId() {
    var txt = document.getElementById("phtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("purchasingHistoryDiv").innerHTML = t;

        }
    }

    r.open("GET", "phInvoiceIdProcess.php?id=" + txt, true);
    r.send();
}

function saveQty(id) {

    var size = document.getElementById("size").value;
    var clr = document.getElementById("clr").value;
    var qty = document.getElementById("qty").value;

    var f = new FormData();

    f.append("pid", id);
    f.append("sid", size);
    f.append("cid", clr);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addQtyProcess.php", true);
    r.send(f);





}
function clear() {
    alert("Your clear functionality here");
}


// function invoice(id,oid) {


//     alert(id);
//     alert(oid);


//     // var r = new XMLHttpRequest();

//     // r.onreadystatechange = function () {
//     //     if (r.readyState == 4) {

//     //         var t = r.responseText();


//     //         if (r == 1) {

//     //         } else {
//     //         }





//     //     }


//     //     r.open("GET", "invoiceadmins.php?id=" + id, true);
//     //     r.send();

//     // }

// }

function invoice(id, nonCartOid) {
    alert(id);
    alert(nonCartOid);

    // var r = new XMLHttpRequest();

    // r.onreadystatechange = function () {
    //     if (r.readyState == 4) {
    //         var t = r.responseText;
    //         window.location = t;
    //     }
    // };

    // r.open("GET", "invoiceadmins.php?id=" + id + "&nonCartOid=" + encodeURIComponent(nonCartOid), true);
    // r.send();
}

