<?php

include 'configure.php';

session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyries Essentials &copy</title>
    <link rel="stylesheet" href="style.css">
    
<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>

    <!-----Home Section starts-->
  <div id="home">

    <header class="header">

      <div class="header-2">

        <div class="flex">

            <div class="left"><img src="pics/logo.png" alt=""></div>

            <nav class="navbar">

                <a href="#">Home</a>
                <a href="about.php">About</a>
                <a href="store.php">Shop</a>
                <a href="#footer">Contact</a>
               

            </nav>

            <div class="icons">

                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="login.php"><div id="user-btn" class="fas fa-user"></div></a>
              
            
            </div>


        </div>

      </div>

    </header>

        <div class="home-title">

            <h2> Just What You Need</h2>

            <h3>Just what you need to keep <br> your skin and hair healthy. </h3>
            <div class="links slide-left">
                <a href="about.php" class="btn">Learn More</a>
        </div>


   </div>


  </div>
 <!-----Home Section ends-->



        <div id="categories">

             <h1>What Tyries Essentials come in.</h1>

            <div class="cat-container">

                <div class="ca-box">
                    <img src="pics/13.jpg" alt="">

                    <div class="label">
                        <h2>Soaps</h2>
                    </div>
                </div>
                <div class="ca-box">
                    <img src="pics/oil.jpg" alt="">

                    <div class="label">
                        <h2>Oils</h2>
                    </div>
                </div>
                <div class="ca-box">
                    <img src="pics/powder.jpg" alt="">

                    <div class="label">
                        <h2>Powder</h2>
                    </div>
                </div>
                <div class="ca-box">
                    <img src="pics/11.jpg" alt="">

                    <div class="label">
                        <h2>Packages</h2>
                    </div>
                </div>

            </div>


        </div>


  <h1>Featured Essentials</h1>
      <main class="products">

      
        <?php
                
                $select_products = mysqli_query($conn, "SELECT * FROM `ty_products` WHERE featured = 'feature'") 
                or die('query failed');

                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                
            ?>
        <section class="card">

            <img src="images/<?php echo $fetch_products['pro_image']; ?>" alt="">

            <div>
                <h3><?php echo $fetch_products['pro_name'];  ?> </h3>
                <h4>Price: Ghc <?php echo $fetch_products['pro_price']; ?></h4>
                <p><?php echo $fetch_products['pro_details']; ?></p>

                    <div class="btns" > <a href="login.php"
                onclick="return confirm('Please Login to add product to cart. You will also be able to view products in your cart and make purchase');">Add-Cart</a></div>
            </div>

        </section>

        <?php
             }
               }else{
                echo   '<p class="empty"> No Products added yet! </p>';
             }

          ?>

     
    </main>

 
 
  <?php include 'footer.php'?>


    <script src="script.js"></script>
</body>
</html>