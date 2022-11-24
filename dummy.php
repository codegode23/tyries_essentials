
<?php

include 'configure.php';

session_start();

$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
    header('location:index.php');
}


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


if(isset($_POST['order_btn'])){


        $name = mysqli_real_escape_string($conn, $_POST['name']);
       
        $select_product_name = mysqli_query($conn, "SELECT name FROM `dum` WHERE name = '$name'") 
        or die('query failed');
    
        if(mysqli_num_rows($select_product_name) > 0) {
            $message[] = 'product name already added';
        }
    
        else{
            $add_product_query = mysqli_query($conn, "INSERT INTO `dum` (name)
             VALUES ('$name')") 
            or die('query failed');
        }
           
        }
    





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyries Essentials Products</title>
    <link rel="stylesheet" href="user.css">
    
    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body>

    <!-----Home Section starts-->
    <div id="store">

        <div class="header">
          <div id="menu-bar" class="fas fa-bars"></div>
          <div class="left">
            
            <img src="logo.png" alt="">
          </div>
          

            <ul class="nav">
                <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="#"><i class="fas fa-info"></i>About</a></li>
                <li><a href="shop.php"><i class="fas fa-shopping-basket"></i>Shop</a></li>
                <li><a href="#"><i class="fas fa-phone"></i>Contact</a></li>
            </ul>


                <?php
                
                    $select_cart_number = mysqli_query($conn, "SELECT * FROM `ty_cart` WHERE cart_user_id = '$user_id'")
                     or die('query failed');

                     $cart_rows_number = mysqli_num_rows($select_cart_number);
                
                ?>


            <div id="user-btn"  class="fas fa-user"></div>
            <div class="cart"> <a href="user_cart.php"><i class="fas fa-shopping-bag"></i>
                 <span>(<?php echo $cart_rows_number; ?>)</span> </a> </div>
            

            <div class="account-box">
            <p>username : <span><?php echo   $_SESSION['user_name'];?></span> </p>
            <p>email : <span><?php echo   $_SESSION['user_email'];?></span> </p>
            <a href="index.php" class="delete-btn">Logout</a>
          </div>

            

        </div>
        
    </div>

    
    <form action="" method="post">

      <h3>Place your order</h3>



        <div class="inputBox">
            <span>Your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
        </div>
             
        
    

     <input type="submit" value="order now!!" class="btn" name="order_btn">

      

    </form>


 
    <script src="user.js"></script>
</body>
</html>