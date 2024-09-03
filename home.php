<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bright & Beyond</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.4/dist/css/uikit.min.css" />

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.4/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.4/dist/js/uikit-icons.min.js"></script>

  <!-- 
    - favicon
  -->
  <!-- <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">-->

  <link rel="icon" href="src/logo/logo.png">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">


  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>


<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>


    <!-- Modal -->
    <div class="modal1 col-12" id="modal">



      <div class="row col-12">
        <div class="col-10">
          <input type="text" name="search" placeholder="Search Product..." class="input-field" id="searchTxt1" style="flex: 1;">
        </div>

        <div class="col-2 d-flex  justify-content-center align-items-center">

          <button class="search-btn" aria-label="Search" onclick="homeSearchSm();">
            <ion-icon name="search-outline"></ion-icon>
          </button>
        </div>


      </div>

    </div>

    </div>
    <!-- Modal -->

    <div class="container">

      <div class="overlay" data-overlay></div>

      <div class="header-search">
        <input type="text" name="search" placeholder="Search Product..." class="input-field" id="searchTxt">

        <button class="search-btn" aria-label="Search" onclick=homeSearch();>
          <ion-icon name="search-outline"></ion-icon>
        </button>


      </div>




      <a href="#" class="logo">
        <!-- <img src="./assets/images/logo.svg" alt="Casmart logo" width="130" height="31"> -->

        Logo
      </a>



      <!-- <a href="#offcanvas-usage" uk-toggle>Open</a> -->



      <div class="header-actions">

        <?php

        session_start();


        require "connection.php";

        if (isset($_SESSION["u"])) {

          $umail = $_SESSION["u"]["email"];


          $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $umail . "'");

          $user_data = $user_rs->fetch_assoc();


        ?>

          <button class="header-action-btn " style="width:200px;" onclick="window.location.href = 'userProfile.php?id=<?php echo $user_data['email']; ?>';">



            <!-- <ion-icon name="person-outline" aria-hidden="true"></ion-icon> -->

            <p class="header-action-label" style="font-size: 20px; margin-left: -20px;">Welcome, <?php echo $user_data["fname"] ?></p>
          </button>

        <?php

        } else {
        ?>

          <button class="header-action-btn">
            <ion-icon name="person-outline" aria-hidden="true"></ion-icon>

            <p class="header-action-label" onclick="window.location.href='index.php'">Sign in</p>
          </button>



        <?php
        }


        ?>

        <button class="header-action-btn" onclick="showSmSearch();">
          <ion-icon name="search-outline" aria-hidden="true"></ion-icon>

          <p class="header-action-label">Search</p>
        </button>

        <?php

        if (isset($_SESSION["u"])) {

          $umail = $_SESSION["u"]["email"];

          $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "'");
          $cart_num = $cart_rs->num_rows;
        ?>
          <button class="header-action-btn" onclick="window.location='cart.php'">
            <ion-icon name="cart-outline" aria-hidden="true"></ion-icon>




            <p class="header-action-label">Cart</p>



            <div class="btn-badge green" aria-hidden="true"><?php echo $cart_num ?></div>
          </button>

        <?php
        } else {

        ?>
          <button class="header-action-btn" onclick="window.location='cart.php'">
            <ion-icon name="cart-outline" aria-hidden="true"></ion-icon>




            <p class="header-action-label">Cart</p>



            <div class="btn-badge green" aria-hidden="true">0</div>
          </button>

        <?php
        }

        ?>

        <?php

        if (isset($_SESSION["u"])) {

          $umail = $_SESSION["u"]["email"];
          $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $umail . "'");
          $watch_num = $watch_rs->num_rows;
        ?>

          <button class="header-action-btn" onclick="window.location='watchlist.php'">
            <ion-icon name="heart-outline" aria-hidden="true"></ion-icon>




            <p class="header-action-label">Wishlisht</p>

            <div class="btn-badge" aria-hidden="true"><?php echo $watch_num ?></div>
          </button>

        <?php

        } else {
        ?>

          <button class="header-action-btn" onclick="window.location='watchlist.php'">
            <ion-icon name="heart-outline" aria-hidden="true"></ion-icon>




            <p class="header-action-label">Wishlisht</p>

            <div class="btn-badge" aria-hidden="true">0</div>
          </button>

        <?php

        }

        ?>

      </div>

      <button class="uk-button uk-button-default col-1 d-flex justify-content-center align-items-center d-sm-flex d-md-flex d-lg-none d-xl-none d-xxl-none " style="border-radius: 5px; border: 2px solid black;" type="button" uk-toggle="target: #offcanvas-flip"><i class="bi bi-filter-right fs-3 fw-bold"></i></button>

      <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar text-black bg-white">

          <button class="uk-offcanvas-close text-black" type="button" uk-close></button>

          <h1 class="text-black">Logo</h1>

          <ul class="navbar-list mt-4">

            <li class="mb-3">
              <button class="filter-btn  active fw-bold fs-1" style=" cursor:auto;">Catogaries</button>
            </li>

            <?php

            $c_rs = Database::search("SELECT * FROM `catogary`");
            $c_num = $c_rs->num_rows;

            for ($y = 0; $y < $c_num; $y++) {

              $c_data = $c_rs->fetch_assoc();

            ?>

              <li>
                <button class="filter-btn" onclick='searchCat(<?php echo $c_data["id"] ?>)'><?php echo $c_data["name"] ?></button>
              </li>

            <?php

            }

            ?>


          </ul>
        </div>
      </div>
      <!-- <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>-->

      <nav class="navbar" data-navbar>

        <!-- <div class="navbar-top">

          <a href="#" class="logo">
            <img src="./assets/images/logo.svg" alt="Casmart logo" width="130" height="31">
          </a>

          <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div> -->

        <ul class="navbar-list mt-4">


          <?php

          $c_rs = Database::search("SELECT * FROM `catogary` LIMIT 4");
          $c_num = $c_rs->num_rows;

          for ($y = 0; $y < $c_num; $y++) {

            $c_data = $c_rs->fetch_assoc();

          ?>

            <li>
              <button class="filter-btn" onclick='searchCat(<?php echo $c_data["id"] ?>)'><?php echo $c_data["name"] ?></button>
            </li>



          <?php

          }


          ?>
          <li>
            <div class="uk-inline">
              <button class="uk-button uk-button-default filter-btn" style="border: none;" type="button">More</button>
              <div class="uk-card uk-card-body uk-card-default" style=" border: 1px solid black;" uk-drop="mode: hover">

                <ul class="">
                  <li>
                    <label for="" class="mb-1" style=" font-family: fantasy;"> All Catogaries</label>
                  </li>


                  <?php

                  $c_rs = Database::search("SELECT * FROM `catogary`");
                  $c_num = $c_rs->num_rows;

                  for ($y = 0; $y < $c_num; $y++) {

                    $c_data = $c_rs->fetch_assoc();

                  ?>

                    <li>
                      <button class="filter-btn" onclick='searchCat(<?php echo $c_data["id"] ?>)'><?php echo $c_data["name"] ?></button>
                    </li>



                  <?php

                  }


                  ?>
                </ul>


              </div>
            </div>
          </li>


          <li>
            <a class="filter-btn  active" href="purchasingHistory.php">My Orders</a>
          </li>


        </ul>









      </nav>

    </div>
  </header>





  <main>

    <div class="col-12" id="results">
      <article>

        <!-- 
        - #HERO
      -->

        <section class="hero" id="home" style="background-image: url('./assets/images/hero-banner.jpg')">
          <div class="container">

            <div class="hero-content">

              <p class="hero-subtitle">Fashion Everyday</p>

              <h2 class="h1 hero-title">Unrivalled Fashion House</h2>

              <button class="btn btn-primary">Shop Now</button>

            </div>

          </div>
        </section>





        <!-- 
        - #SERVICE
      -->






        <section class="service">
          <div class="container">

            <ul class="service-list">

              <li class="service-item">
                <div class="service-item-icon">
                  <img src="./assets/images/service-icon-1.svg" alt="Service icon">
                </div>

                <div class="service-content">
                  <p class="service-item-title">Free Shipping</p>

                  <p class="service-item-text">On All Order Over <br>USD 10,000</p>
                </div>
              </li>



              <li class="service-item">
                <div class="service-item-icon">
                  <img src="./assets/images/service-icon-3.svg" alt="Service icon">
                </div>

                <div class="service-content">
                  <p class="service-item-title">Secure Payment</p>

                  <p class="service-item-text">100% Secure Gaurantee</p>
                </div>
              </li>

              <li class="service-item">
                <div class="service-item-icon">
                  <img src="./assets/images/service-icon-4.svg" alt="Service icon">
                </div>

                <div class="service-content">
                  <p class="service-item-title">Special Support</p>

                  <p class="service-item-text">24/7 Dedicated Support</p>
                </div>
              </li>

            </ul>

          </div>
        </section>







        <div class="bg-white">
          <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

            <h2 class="h2 section-title">Best Sellings</h2>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

              <?php

              $product_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' AND `sales` >= 10 LIMIT 4");


              $product_num = $product_rs->num_rows;

              for ($z = 0; $z < $product_num; $z++) {
                $product_data = $product_rs->fetch_assoc();



              ?>

                <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>" class="group">

                  <?php

                  $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
                  $image_data = $image_rs->fetch_assoc();

                  ?>
                  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                    <img src="<?php echo $image_data["url"]; ?>" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-contain object-center ">
                  </div>
                  <h3 class="mt-4 text-sm text-gray-700"><?php echo $product_data["title"] ?></h3>


                  <?php

                  $price = $product_data["price"];
                  $addttion = $price * 0.1;

                  $fakePrice = $price + $addttion;

                  ?>
                  <p class="mt-1 text-lg font-medium text-gray-900" style=":;">USD <?php echo $fakePrice ?></p>
                </a>

              <?php

              }

              ?>


              <!-- More products... -->
            </div>
          </div>
        </div>






        <!-- 
        - #PRODUCT
      -->

        <section class="section product" id="">
          <div class="container">

            <h2 class="h2 section-title">Products of the week</h2>



            <ul class="product-list gap-3" id="product_list">

              <?php

              $product_rs = Database::search("SELECT * FROM `product` WHERE
`status_id`='1' ORDER BY `date_time` DESC LIMIT 8 OFFSET 0");

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


                      <img src="<?php echo $image_data["url"]; ?>" alt="<?php $product_data["title"] ?>" style="width: 100%; height:400px;" class="" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">


                      <!-- <div class="card-badge red"> -25%</div> -->

                      <div class="card-actions">

                        <button class="card-action-btn" aria-label="Quick view">
                          <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' style="color: black;"><ion-icon name="eye-outline" onclick="singleProduct();"></ion-icon></a>
                        </button>

                        <button class="card-action-btn cart-btn" onclick="window.location.href = 'singleProductView.php?id=<?php echo $product_data['id']; ?>';">
                          <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>

                          <p>Add to Cart</p>
                        </button>

                        <button class="card-action-btn" aria-label="Add to Whishlist" onclick="addToWatchlist(<?php echo $product_data['id'] ?>)">
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

          <button class="btn btn-outline" onclick="allProduct();">View All Products</button>
        </section>





        <!-- 
        - #BLOG
      -->

        <section class="section blog">
          <div class="container">

            <h2 class="h2 section-title">Latest fashion news</h2>

            <ul class="blog-list">

              <li>
                <div class="blog-card">

                  <figure class="card-banner">
                    <a href="#">
                      <img src="./assets/images/blog-1.jpg" alt="Worthy Cyber Monday Fashion From Casmart" loading="lazy" width="1020" height="700" class="w-100">
                    </a>
                  </figure>

                  <div class="card-content">

                    <ul class="card-meta-list">

                      <li class="card-meta-item">
                        <ion-icon name="folder-open-outline"></ion-icon>

                        <a href="#" class="card-meta-link">Fashion</a>
                      </li>

                      <li class="card-meta-item">
                        <ion-icon name="time-outline"></ion-icon>

                        <a href="#" class="card-meta-link">
                          <time datetime="2021-03-31">31 Mar 2021</time>
                        </a>
                      </li>

                    </ul>

                    <h3 class="h3 card-title">
                      <a href="#">Worthy Cyber Monday Fashion From Casmart</a>
                    </h3>

                  </div>

                </div>
              </li>

              <li>
                <div class="blog-card">

                  <figure class="card-banner">
                    <a href="#">
                      <img src="./assets/images/blog-2.jpg" alt="Holiday Home Decoration I’ve Recently Ordered" loading="lazy" width="1020" height="700" class="w-100">
                    </a>
                  </figure>

                  <div class="card-content">

                    <ul class="card-meta-list">

                      <li class="card-meta-item">
                        <ion-icon name="folder-open-outline"></ion-icon>

                        <a href="#" class="card-meta-link">Fashion</a>
                      </li>

                      <li class="card-meta-item">
                        <ion-icon name="time-outline"></ion-icon>

                        <a href="#" class="card-meta-link">
                          <time datetime="2021-03-31">31 Mar 2021</time>
                        </a>
                      </li>

                    </ul>

                    <h3 class="h3 card-title">
                      <a href="#">Holiday Home Decoration I’ve Recently Ordered</a>
                    </h3>

                  </div>

                </div>
              </li>

              <li>
                <div class="blog-card">

                  <figure class="card-banner">
                    <a href="#">
                      <img src="./assets/images/blog-3.jpg" alt="Unique Ideas for Fashion You Haven’t heard yet" loading="lazy" width="1020" height="700" class="w-100">
                    </a>
                  </figure>

                  <div class="card-content">

                    <ul class="card-meta-list">

                      <li class="card-meta-item">
                        <ion-icon name="folder-open-outline"></ion-icon>

                        <a href="#" class="card-meta-link">Fashion</a>
                      </li>

                      <li class="card-meta-item">
                        <ion-icon name="time-outline"></ion-icon>

                        <a href="#" class="card-meta-link">
                          <time datetime="2021-03-31">31 Mar 2021</time>
                        </a>
                      </li>

                    </ul>

                    <h3 class="h3 card-title">
                      <a href="#">Unique Ideas for Fashion You Haven’t heard yet</a>
                    </h3>

                  </div>

                </div>
              </li>

            </ul>

          </div>
        </section>




    </div>




    <!-- 
    - #FOOTER
  -->

    <footer class="footer">

      <div class="footer-top">
        <div class="container">

          <div class="footer-brand">

            <a href="#" class="logo">
              <!-- <img src="./assets/images/logo.svg" alt="Casmart logo">-->
              Logo
            </a>

            <p class="footer-text">
              Bright & Beyond is a fashion theme for presents a complete wardrobe of uniquely crafted Ethnic Wear, Casuals, Edgy
              Denims, &
              Accessories inspired from the most contemporary
            </p>

            <ul class="social-list">

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

              <li>
                <a href="#" class="social-link">
                  <ion-icon name="logo-pinterest"></ion-icon>
                </a>
              </li>

            </ul>

          </div>

          <ul class="footer-list">

            <li>
              <p class="footer-list-title">Information</p>
            </li>

            <li>
              <a href="#" class="footer-link">About Company</a>
            </li>

            <li>
              <a href="#" class="footer-link">Payment Type</a>
            </li>

            <li>
              <a href="#" class="footer-link">Awards Winning</a>
            </li>

            <li>
              <a href="#" class="footer-link">World Media Partner</a>
            </li>

            <li>
              <a href="#" class="footer-link">Become an Agent</a>
            </li>

            <li>
              <a href="#" class="footer-link">Refund Policy</a>
            </li>

          </ul>

          <ul class="footer-list">

            <li>
              <p class="footer-list-title">Category</p>
            </li>


            <?php

            $c_rs = Database::search("SELECT * FROM `catogary`");
            $c_num = $c_rs->num_rows;

            for ($y = 0; $y < $c_num; $y++) {

              $c_data = $c_rs->fetch_assoc();

            ?>

              <li>
                <a href="#" class="footer-link"><?php echo $c_data["name"] ?></a>
              </li>
            <?php


            }

            ?>


          </ul>

          <ul class="footer-list">

            <li>
              <p class="footer-list-title">Help & Support</p>
            </li>

            <li>
              <a href="#" class="footer-link">Dealers & Agents</a>
            </li>

            <li>
              <a href="#" class="footer-link">FAQ Information</a>
            </li>

            <li>
              <a href="#" class="footer-link">Return Policy</a>
            </li>

            <li>
              <a href="#" class="footer-link">Shipping & Delivery</a>
            </li>

            <li>
              <a href="#" class="footer-link">Order Tranking</a>
            </li>

            <li>
              <a href="#" class="footer-link">List of Shops</a>
            </li>

          </ul>

        </div>
      </div>

      <div class="footer-bottom">
        <div class="container">

          <p class="copyright">
            &copy; 2024 <a href="#">Bright & Beyond</a>. All Rights Reserved
          </p>

          <ul class="footer-bottom-list">

            <li>
              <a href="#" class="footer-bottom-link">Privacy Policy</a>
            </li>

            <li>
              <a href="#" class="footer-bottom-link">Terms & Conditions</a>
            </li>

            <li>
              <a href="#" class="footer-bottom-link">Sitemap</a>
            </li>

          </ul>

          <div class="payment">
            <p class="payment-title">We Support</p>

            <img src="./assets/images/payment-img.png" alt="Online payment logos" class="payment-img">
          </div>

        </div>
      </div>

    </footer>






    <!-- 
    - custom js link
  -->
    <script src="./assets/js/script.js"></script>

    <!-- 
    - ionicon link
  -->

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
  </main>
</body>

</html>