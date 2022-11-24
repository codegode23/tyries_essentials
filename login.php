<?php

include 'configure.php';
session_start();

if(isset($_POST['submit'])){
   
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    

   $select_users = mysqli_query($conn, "SELECT * FROM `ty_users` WHERE user_email = '$email' AND user_password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0) {
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

        $_SESSION['admin_name'] = $row['user_name'] ;
        $_SESSION['admin_email'] = $row['user_email'] ;
        $_SESSION['admin_id'] = $row['id'] ;
        header('location:admin_page.php');
      }
      elseif($row['user_type'] == 'user'){

        $_SESSION['user_name'] = $row['user_name'] ;
        $_SESSION['user_email'] = $row['user_email'] ;
        $_SESSION['user_id'] = $row['id'] ;
        header('location:home.php');

      }
   }
   else{
    $message[] = 'incorrect email or password!';
   }

   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
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
<div class="form-container">

<form action="" method="post">

<h3>Login now</h3>

<input type="text" name="email" placeholder="enter your email" required class="box">

<input type="password" name="password" placeholder="enter your password" required class="box">

<input type="submit" name="submit" value="login now" class="btns">

<p>don't have an account? <a href="register.php">register now</a></p>

</form>

</div>

</body>
</html>