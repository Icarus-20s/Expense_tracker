<?php
session_start();
error_reporting(0);
include('db_config.php');

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT ID FROM user WHERE Email='$email' && Password='$password'");
    $ret = mysqli_fetch_array($query);
    if($ret > 0){
        $_SESSION['userid'] = $ret['ID'];
        header('location:index.php');
    } else {
        $msg = "Invalid Details.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker - Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
        body {
            background-color: #232323; /* Dark background color */
            color: #ffffff; /* Text color */
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent dark container */
            margin-top: 100px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        .login-heading {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .login-link {
            color: #007bff;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-container">
                <h2 class="login-heading">Daily Expense Tracker</h2>
                <form role="form" action="" method="post" id="login-form" name="login">
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="true">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
                    </div>
                    <button type="submit" value="login" name="login" class="btn btn-primary btn-block">Login</button>
                    <p class="text-center mt-3">Don't have an account? <a class="login-link" href="register.php">Register</a></p>
                </form>
                <p style="font-size: 16px; color: red; text-align: center;"><?php if($msg){ echo $msg; } ?></p>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
