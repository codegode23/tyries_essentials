

<?php

include 'configure.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

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


if(isset($_POST['update_cart'])){

    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE `ty_cart` SET cart_quantity = '$cart_quantity' WHERE id = '$cart_id' ")
    or die ('query failed');

    $message[] = 'cart quantity updated!';

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `ty_cart` WHERE id = '$delete_id'")
    or die('query failed');
    header('location:user_cart.php');
}


if(isset($_GET['delete_all'])){
   
    mysqli_query($conn, "DELETE FROM `ty_cart` WHERE cart_user_id = '$user_id'")
    or die('query failed');
    header('location:user_cart.php');
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
                    <a href="#order">Orders</a>

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

    
     <section class="shopping-cart">

       <h1 class="title">Essentials in my cart</h1>

      <div class="box-container">

            <?php

                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM `ty_cart`
                WHERE cart_user_id = '$user_id' ")
                or die('QUERY FAILED');

                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>

            <div class="box">
                

             <a href="user_cart.php/?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times"
                onclick="return confirm('delete this from cart?');"></a>

                <img class="image" src="<?php echo $fetch_cart['cart_image']; ?>" alt="">
            
                <div class="name"> <?php echo $fetch_cart['cart_name']; ?> </div>

                <div class="price">GHc <?php echo $fetch_cart['cart_price']; ?> </div>

             <form action="" method="post">

                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id'];?>">


                <p>Quantity</p>
                <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['cart_quantity'];?>">

                <input type="submit" name="update_cart" value="update" class="update-btn">

             </form>

            <div class="sub-total"><span>sub total: Ghc <?php 
            echo $sub_total = ($fetch_cart['cart_quantity'] * $fetch_cart['cart_price']);
            
            ?> </span></div>

            </div>

            <?php

            $grand_total += $sub_total;
                    }
                }else{
                    echo '<p class="empty"> Your cart is empty</p>';
                }

            ?>

        </div>

            
            <div style="margin-top: 2rem; text-align:center;">

                <a href="user_cart.php?delete_all" 
                class="delete-btn  <?php echo ($grand_total > 1)?'': 'disabled';
                ?>" onclick="return confirm('delete all from cart?');">Delete all</a>

            </div>

            <div class="cart-total">

                <p>Grand total : <span>Ghc <?php echo $grand_total; ?> </span></p>

                <div class="flex">

                    <a href="shop.php" class="option-btn">Continue Shopping</a>
                    <a href="user_checkout.php" class="btn <?php echo ($grand_total > 1)?'': 'disabled';
                    ?>">Proceed to checkout</a>

                </div>

            </div>
     </section>

     <div id="order">
      <section class="placed-orders">

            <h1 class="title">Placed Orders</h1>

            <div class="box-container">

        <?php
                
        $order_query = mysqli_query($conn, "SELECT * FROM `ty_orders` WHERE user_id = '$user_id'")
        or die('query failed');

        if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){   
        ?>
    <div class="box">

   

        <p> Placed on : <span> <?php echo $fetch_orders['placed_on'];?> </span> </p>

        <p> Name : <span> <?php echo $fetch_orders['name'];?> </span> </p>

        <p> Number : <span> <?php echo $fetch_orders['number'];?> </span> </p>

        <p> Email : <span> <?php echo $fetch_orders['email'];?> </span> </p>

        <p> Address : <span> <?php echo $fetch_orders['address'];?> </span> </p>

        <p> Payment method : <span> <?php echo $fetch_orders['method'];?> </span> </p>

        <p> Your orders : <span> <?php echo $fetch_orders['total_products'];?> </span> </p>

        <p> Total price : <span>Ghc <?php echo $fetch_orders['total_price'];?> </span> </p>

        <p> Payment status : <span style="color:<?php
        if($fetch_orders['payment_status'] == 'pending'){echo 'red';}else{echo 'green';} ?>"> 
        <?php echo $fetch_orders['payment_status'];?> </span> </p>

    </div>

    <?php
         }

        } else{
            echo '<p class="empty">no orders placed yet</p>';
        }
    
    ?>

</div>


</section>
    </div>
  


 



     
     <?php include 'footer.php'?>

    <script src="user.js"></script>
</body>
</html>