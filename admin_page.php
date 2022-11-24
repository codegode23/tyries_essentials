
<?php

include 'configure.php';

session_start();


$admin_id =  $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

   
<?php include 'admin_header.php';
?>

    <!---Admin Dashboard section Starts-->

<section class="dashboard">

<h1 class="title">Dashboard</h1>

<div class="box-container">
    
    <div class="box">
         
         <?php
         
             $total_pendings = 0;
             $select_pending = mysqli_query($conn, "SELECT total_price FROM `ty_orders` WHERE payment_status = 'pending'") 
             or die('query failed');

         if(mysqli_num_rows($select_pending) > 0){
             while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                 $total_price = $fetch_pendings['total_price'];
                 $total_pendings += $total_price;
             };
         };
         ?>
          
          <h3> Ghc <?php echo $total_pendings;  ?></h3>
          <p>total pendings</p>

    </div>
    
    <div class="box">
         
            <?php
            
                $total_completed = 0;
                $select_completed = mysqli_query($conn, "SELECT total_price FROM `ty_orders` WHERE payment_status = 'completed'") 
                or die('query failed');

            if(mysqli_num_rows($select_completed) > 0){
                while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                    $total_price = $fetch_completed['total_price'];
                    $total_completed += $total_price;
                };
            };
            ?>
             
             <h3> Ghc <?php echo $total_completed;  ?> </h3>
             <p>completed payments</p>
  
       </div>
   
    <div class="box">
       <?php

       $select_users = mysqli_query($conn, "SELECT * FROM `ty_users` WHERE user_type = 'user'") 
       or die('query failed');

       $number_of_users = mysqli_num_rows($select_users);
       
       
       ?>

       <h3> <?php echo $number_of_users; ?> </h3>
       <p>Customers</p>
   </div>

   
   <div class="box">
       <?php

       $select_admins = mysqli_query($conn, "SELECT * FROM `ty_users` WHERE user_type = 'admin'") 
       or die('query failed');

       $number_of_admins = mysqli_num_rows($select_admins);
       
       
       ?>

       <h3> <?php echo $number_of_admins; ?> </h3>
       <p>admin users</p>
   </div>

   
   <div class="box">
       <?php

       $select_account = mysqli_query($conn, "SELECT * FROM `ty_users`") 
       or die('query failed');

       $number_of_account = mysqli_num_rows($select_account);
       
       
       ?>

       <h3> <?php echo $number_of_account; ?> </h3>
       <p>total users</p>
   </div>

   <div class="box">
       <?php

       $select_account = mysqli_query($conn, "SELECT * FROM `ty_products`") 
       or die('query failed');

       $number_of_account = mysqli_num_rows($select_account);
       
       
       ?>

       <h3> <?php echo $number_of_account; ?> </h3>
       <p> products added</p>
   </div>



   


</div>


</section>


<!---Admin Dashboard section Endss-->






<script src="admin_script.js"></script>
</body>
</html>