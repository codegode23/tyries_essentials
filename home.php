

<?php

include 'configure.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name =   $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:index.php');
}





if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['pro_quantity'];

  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `ty_cart` WHERE cart_name='$product_name' AND cart_user_id='$user_id'") 
  or die('query failed');

  if(mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart';
  }else{
      mysqli_query($conn, "INSERT INTO `ty_cart` (cart_user_id, cart_user_name, cart_name, cart_price, cart_quantity, cart_image)
       VALUES('$user_id', '$user_name', '$product_name', '$product_price', '$product_quantity', '$product_image')")
      or die('query failed');

      $message[] = 'product added to cart';
  }
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

    <?php

    if(isset($message)){
      foreach($message as $message){
          echo '
          
          <div class="message">
          <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
          </div>
          ';
      }
    }
    ?>


    <!-----Home Section starts-->
    <div id="home">

      <header class="header">
        <div class="header-2">

          <div class="flex">
           <div class="left"><img src="pics/logo.png" alt=""></div>

                <nav class="navbar">

                    <a href="#">Home</a>
                    <a href="user_about.php">About</a>
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

        <div class="home-title">

            <h2> Just What You Need</h2>

            <h3>Just what you need to keep <br> your skin and hair healthy. </h3>
            <div class="links slide-left">
                <a href="user_about.php" class="btn">Learn More</a>
        </div>


    </div>
 <!-----Home Section ends-->

 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
                
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

            
                    
                    $select_products = mysqli_query($conn, "SELECT * FROM `ty_products`") 
                    or die('query failed');

                    if(mysqli_num_rows($select_products) > 0){
                        while($fetch_products = mysqli_fetch_assoc($select_products)){
                    
            ?>

<form action="" method="post" class="box" >
    <section class="card">

        

            <img src="images/<?php echo $fetch_products['pro_image']; ?>" alt="">

            <div>

                <h3><?php echo $fetch_products['pro_name'];  ?> </h3>
                <h4>Price: Ghc <?php echo $fetch_products['pro_price']; ?></h4>
                <p><?php echo $fetch_products['pro_details']; ?></p>
               
                <input type="number" min="1" name="pro_quantity" value="1">

                <input type="hidden" name="product_name" value=" <?php echo $fetch_products['pro_name'];  ?> ">
                <input type="hidden" name="product_price" value=" <?php echo $fetch_products['pro_price']; ?>">
                <input type="hidden" name="product_image" value=" <?php echo $fetch_products['pro_image']; ?>">

                
                <input type="submit" value="add-cart" class="btns" name="add_to_cart">
            </div>
    
    </section>
</form>
<?php
     }
       }else{
        echo   '<p class="empty"> No Products added yet! </p>';
     }

    ?>

</main>


<?php include 'footer.php'?>

    <script src="user.js"></script>
</body>
</html>