
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
    <title>Tyries Essentials Products</title>
    <link rel="stylesheet" href="style.css">
    
<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body>

    <!-----Home Section starts-->
    <div id="store">

    <header class="header">

<div class="header-2">

  <div class="flex">

      <div class="left"><img src="pics/logo.png" alt=""></div>

      <nav class="navbar">

          <a href="index.php">Home</a>
          <a href="about.php">About</a>
          <a href="#">Shop</a>
          <a href="#footer">Contact</a>
          

      </nav>

      <div class="icons">

          <div id="menu-btn" class="fas fa-bars"></div>
         
          
          <a href="login.php"><div id="user-btn" class="fas fa-user"></div></a>
          <a href="cart.php"></a>
      
      </div>


  </div>

</div>

</header>

        
    </div>

   
      <!-----Home Section ends-->

      <!----Products Section Starts-->

      <h1>All Essentials</h1>
      <main class="products">

      
        <?php
                
                $select_products = mysqli_query($conn, "SELECT * FROM `ty_products`") 
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
                onclick="return confirm('Login to add product to cart');">Add-Cart</a></div>
            </div>

        </section>

        <?php
             }
               }else{
                echo   '<p class="empty"> No Products added yet! </p>';
             }

          ?>

     
    </main>

    <div class="login-msg">

<h2>Please Login to add product to cart</h2>

<a href="login.php" class="fas fa-user"> Login</a>

<a href="store.php" class="fas fa-arrow-left"> Back</a>


</div>

      <!----Products Section Ends-->


      <?php include 'footer.php'?>

    <script src="script.js"></script>
</body>
</html>