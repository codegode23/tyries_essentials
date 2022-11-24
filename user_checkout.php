
<?php

include 'configure.php';

session_start();

$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
    header('location:index.php');
}


if(isset($_POST['order_btn'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number =  $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = "";

    $cart_query = mysqli_query($conn, "SELECT * FROM `ty_cart` WHERE cart_user_id = '$user_id'")
    or die('query failed');

    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['cart_name'].' ('.$cart_item['cart_quantity'].')';
            $sub_total = ($cart_item['cart_price'] * $cart_item['cart_quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(" ", $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `ty_orders` WHERE name = '$name' 
    AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' 
    AND total_products = '$total_products' AND total_price = '$cart_total'") 
    or die('query failed');

    if($cart_total == 0){
        $message[] = 'Your cart is empty';
     }else{
        if(mysqli_num_rows($order_query) > 0){
            $message[] = 'order already placed';
        }else{
            mysqli_query($conn, "INSERT INTO `ty_orders` (user_id, name, number, email, method, address, total_products, total_price, placed_on) 
            VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')")
             or die('query failed');
            $message[] = 'order placed successfully!';
            
            mysqli_query($conn, "DELETE FROM `ty_cart` WHERE cart_user_id = '$user_id' ")
            or die('query failed');
        }
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
    <div id="store">

    <header class="header">
        <div class="header-2">

          <div class="flex">
           <div class="left"><img src="pics/logo.png" alt=""></div>

                <nav class="navbar">

                    <a href="home.php">Home</a>
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

        
    </div>

    <section class="display-order">

        <?php
        
        $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `ty_cart` WHERE cart_user_id = '$user_id' ") 
            or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $total_price = ($fetch_cart['cart_price'] * $fetch_cart['cart_quantity']);
                    $grand_total += $total_price;
        ?>

           <p> <?php echo $fetch_cart['cart_name']; ?> <span> 
               (<?php echo 'Ghc' . $fetch_cart['cart_price'] .   '  x  ' . $fetch_cart['cart_quantity']. ' = ' . $total_price; ?>)
         </span> </p>         

        <?php
              }
            }else{
                echo '<p class="empty"> Your cart is empty</p>';
            }
        ?>

            <div class="grand-total"> Grand total : <span>Ghc<?php echo $grand_total ; ?></span></div>

    </section>

    <section class="checkout">

    <form action="" method="post">

      <h3>Place your order</h3>

     <div class="flex">

        <div class="inputBox">
            <span>Your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
        </div>
        
        <div class="inputBox">
            <span>Your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
        </div>
        
        <div class="inputBox">
            <span>Your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
        </div>
        
        <div class="inputBox">
            <span>Payment method :</span>
            <select name="method" id="">
                <option value="cash on delivery">Cash on delivery</option>
                <option value="credit card">Credit card</option>
                <option value="paypal">Paypal</option>
                <option value="paytm">Paytm</option>
            </select>

        </div>
       
          
        <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="address" required placeholder="e.g. Accra-Ghana">
        </div>
        
        
     </div>

     <input type="submit" value="order now!!" class="btns" name="order_btn">

      

    </form>



</section>




            
<?php include 'footer.php'?>
 
    <script src="user.js"></script>
</body>
</html>