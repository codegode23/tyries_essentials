<?php


include 'configure.php';

session_start();


$user_id =   $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:logout.php');
}



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

                    <a href="home.php">Home</a>
                    <a href="#">About</a>
                    <a href="shop.php">Shop</a>
                    <a href="#footer">Contact</a>
                    <a href="user_cart.php#order">Orders</a>

                </nav>

                <div class="icons">

                    <div id="menu-btn" class="fas fa-bars"></div>

                    <?php
                    
                        $select_cart_number = mysqli_query($conn, "SELECT * FROM `ty_cart` WHERE cart_user_id = '$user_id'")
                        or die('query failed');

                        $cart_rows_number = mysqli_num_rows($select_cart_number);
                    
                    ?>

                    <div id="user-btn" class="fas fa-user"></div>
                    <a href="user_cart.php"><i class="fas fa-shopping-cart"></i>
                    <span>(<?php echo $cart_rows_number; ?>)</span> </a>

                </div>

                <div class="user-box">
                    <p>Username : <span> <?php echo $_SESSION['user_name']; ?> </span> </p>
                    <p>Email : <span> <?php echo $_SESSION['user_email']; ?> </span> </p>
                    <a href="logout.php" class="delete-btn">Logout</a>
                    
                </div>

            </div>

        </div>

      </header>


    </div>
 <!-----Home Section ends-->

  <!-----About Section starts-->

  <div id="about">

    <div class="abt-container">

     <img src="pics/5.jpg" alt="">
       

        <div class="abt-info">
            <h1>About</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Expedita reiciendis ipsum ratione quia accusamus quis nostrum 
                 doloremque provident explicabo magnam molestias, vel at aut. 
                 Expedita reiciendis ipsum ratione quia accusamus quis nostrum 
                 doloremque provident explicabo magnam molestias, vel at aut. 
                 Expedita reiciendis ipsum ratione quia accusamus quis nostrum <br>
                 doloremque provident explicabo magnam molestias, vel at aut. 
                 Expedita reiciendis ipsum ratione quia accusamus quis nostrum 
                 doloremque provident explicabo magnam molestias, vel at aut. 
                 Expedita reiciendis ipsum ratione quia accusamus quis nostrum 
                 doloremque provident explicabo magnam molestias, vel at aut. 
                 Accusantium provident voluptas reprehenderit praesentium doloremque.</p>
        </div>

    </div>
<!----Benefits Section Starts-->
    <div class="benefits">

      <h1>Benefits Of Using <span>Tyries</span> </h1>

      <div class="benefits-container">
        <div class="benefit-box">
          <i class="fas fa-clock"></i>

          <h4>Long lasting</h4>
          <p>Our products are capable of lasting long and still maintainig thier benefits </p>
        </div>
        <div class="benefit-box">
          <i class="fab fa-drupal"></i>

          <h4>Smooth Skin</h4>
          <p>Our products are capable of lasting long and still maintainig thier benefits </p>
        </div>
        <div class="benefit-box">
          <i class="fas fa-clock"></i>

          <h4>Long lasting</h4>
          <p>Our products are capable of lasting long and still maintainig thier benefits </p>
        </div>
      </div>


    </div>
<!----Benefits Section ends-->
  

<div id="founder">

<h1>Founder</h1>

<div class="founder-container">

  <div class="founder-info">
    <h3>Ruth Tyries Afoley Tettey</h3>

    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt corrupti laborum 
      in officia eaque excepturi possimus. Quos quibusdam natus obcaecati, deleniti sint
       debitis et doloribus cupiditate quisquam, perspiciatis dolor consequatur.</p>
  </div>

  <img src="pics/16.png" alt="">

</div>


</div>
 

 
 
  <?php include 'footer.php'?>


    <script src="user.js"></script>
</body>
</html>