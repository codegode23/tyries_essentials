
<?php

include 'configure.php';

session_start();


$admin_id =  $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['add_product'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $feature = $_POST['feature'];
    $category = $_POST['category'];
    $details = $_POST['details'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/'.$image;

    $select_product_name = mysqli_query($conn, "SELECT pro_name FROM `ty_products` WHERE pro_name = '$name'") 
    or die('query failed');

    if(mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'product name already added';
    }

    else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `ty_products` (pro_name,pro_price,pro_details,pro_image,featured,category)
         VALUES ('$name', '$price', '$details', '$image', '$feature', '$category')") 
        or die('query failed');

        if($add_product_query){
            if($image_size > 200000){
                $message[] = 'image size is too large';
            }
            else{
                 move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
            }
           
        }
        else{
            $message[] = 'product could not be added successfully!';
        }
    }
}



if(isset($_POST['update_product'])){

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_p_details = $_POST['update_details'];

    mysqli_query($conn, "UPDATE `ty_products` SET pro_name = '$update_name', pro_price = '$update_price',
     pro_details = '$update_p_details' WHERE id = '$update_p_id'") 
    or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'images/'.$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size > 2000000) {
            $message[] = 'image file size is too large';
        }else{
            mysqli_query($conn, "UPDATE `ty_products` SET pro_image = '$update_image' WHERE id = '$update_p_id'") 
            or die('query failed');

            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('images/'.$update_old_image);

        }
    }

    header('location:admin_products.php');
}


if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT pro_image FROM `ty_products` WHERE id = '$delete_id'")
     or die('quey failed');

     $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
     unlink('images/'.$fetch_delete_image['pro_image']);
    

    mysqli_query($conn, "DELETE FROM `ty_products` WHERE id = '$delete_id'") 
    or die('query failed');

    header('location:admin_products.php');
}








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products page</title>
    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    

<?php include 'admin_header.php';
?>


<section class="add-products">

<h1 class="title">Essentials</h1>

<form action="" method="post" enctype="multipart/form-data">
    <h3>Add Essentials here</h3>
    <input type="text" name="name" class="box" placeholder="enter product name" required>

    <select name="feature" class="box">
            <option value="feature">feature</option>
            <option value="nofeature">nofeature</option>
            </select>

       
    <select name="category" class="box">
            <option value="Soap">Soap</option>
            <option value="Powder">Powder</option>
            <option value="Oil">Oil</option>
            <option value="Package">Package</option>
            </select>
     

    <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>

    <textarea name="details" id="" cols="20" rows="10" required placeholder="enter product details" class="box"></textarea>

    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>

    <input type="submit" value="add product" name="add_product" class="btns">
</form>




</section>

<!---Show the products added---->

<section class="show-products">

    <div class="box-container">
        <?php
        
            $select_products = mysqli_query($conn, "SELECT * FROM `ty_products`") 
            or die('query failed');

            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            
        ?>
            <div class="box">
                <img src="images/<?php echo $fetch_products['pro_image'];?>" alt="">

                <div class="name"><?php echo $fetch_products['pro_name'];?></div>
                <div class="name">Category: <?php echo $fetch_products['category'];?></div>
                <div class="price">Ghc <?php echo $fetch_products['pro_price'];?></div>
                <div class="details"><?php echo $fetch_products['pro_details'];?></div>
                

                <a href="admin_products.php?update=<?php echo $fetch_products['id'];?>" 
                class="update-btn">Update</a>

                <a href="admin_products.php?delete=<?php echo $fetch_products['id'];?>" 
                class="delete-btn" onclick="return confirm('delete this product?')">Delete</a> 

            </div>
        <?php
                }
        }else{
            echo '<p class="empty">no product added yet!</p>';
        }
            
        ?>
    </div>

</section>



<section class="edit-product-form">

        <?php
        
            if(isset($_GET['update'])) {
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn, "SELECT * FROM `ty_products` WHERE id='$update_id'") 
                or die('query failed');
                if(mysqli_num_rows($update_query) > 0) {
                    while($fetch_update = mysqli_fetch_assoc($update_query)){

                    
              
        
        ?>
            <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">

            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['pro_image']; ?>">

            <img src="images/<?php echo $fetch_update['pro_image']; ?>" alt=""  >

            <input type="text" name="update_name" value="<?php echo $fetch_update['pro_name']; ?>" 
            class="box" required placeholder="enter product name">
            
            <input type="text" name="update_price" value="<?php echo $fetch_update['pro_price']; ?>" 
            class="box" >

           <input type="text" name="update_details" id="details" value="<?php echo $fetch_update['pro_details']?>" class="box">
            
            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">

            <input type="submit" value="update" name="update_product" class="update-btn">

            <input type="reset" value="cancel" id="close-update" class="delete-btn">

            </form>

        <?php

          }
          }
        }else{
            echo '<script> document.querySelector(".edit-product-form").style.display = "none"; </script>';
        }
        ?>




</section>    








<script src="admin_script.js"></script>
</body>
</html>
