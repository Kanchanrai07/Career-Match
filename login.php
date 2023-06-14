<?php
@include 'config.php';
session_start();
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type=$_POST['user_type'];

    $select= "SELECT * FROM user_form WHERE email = '$email' && password ='$pass'";

    $result= mysqli_query($conn, $select);

    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_array($result);
     if($row['user_type'] == 'admin'){
        $_SESSION['admin_name'] = $row['name'];
        header('location:postjob.php');
     }
    }
};


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http--equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Login Form</title>
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>LogIn</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class ="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login" class="form-btn" href="shop.php">
            <p>Don't have an account? <a href="signin.php">SignUp</a></p>

        </form>
    </div>
</body>

</html>