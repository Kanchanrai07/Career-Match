<?php
@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type=$_POST['user_type'];

    $select= "SELECT * FROM user_form WHERE email = '$email' && password ='$pass'";

    $result= mysqli_query($conn, $select);

    if(mysqli_num_rows($result)>0){
        $error[] = 'user already exists';

    }else{
        if($pass != $cpass){
            $error[] = 'password not matched';
        }else{
            $insert ="INSERT INTO user_form(name, email, password,user_type) VALUES('$name','$email','$pass','$user_type')";
       mysqli_query($conn, $insert);
       header('location:login.php');
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
    <title>Registration Form</title>
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3> Register Now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class ="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="text" name="name" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your email id">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cpassword" required placeholder="Confirm your password">
            <select name="user_type">
                <option value="user">Job Seeker</option>
                <option value="admin">Employer</option>
            <input type="submit" name="submit" value="Register Now" class="form-btn" href="index.php">
            <p>Already have an account? <a href="login.php">Login</a></p>

        </form>
    </div>
</body>

</html>