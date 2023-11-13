<?php
session_start();
error_reporting(0);
include('db_config.php');

if (strlen($_SESSION['userid']) == 0) {
    header('location: logout.php');
} else {
    if (isset($_POST['submit'])) {
        $userid = $_SESSION['userid'];
        $fullname = $_POST['fullname'];
        $mobno = $_POST['contactnumber'];

        $query = mysqli_query($con, "UPDATE user SET FullName ='$fullname', MobileNumber='$mobno' WHERE ID='$userid'");
        if ($query) {
            $msg = "User profile has been updated.";
        } else {
            $msg = "Something Went Wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker - User Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .profile-container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
            padding: 20px;
        }

        .profile-heading {
            font-size: 28px;
            margin-bottom: 20px;
            color: #007bff;
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

        .error-msg {
            font-size: 16px;
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="profile-container">
                <div class="profile-heading">User Profile</div>
                <p class="error-msg"><?php if ($msg) echo $msg; ?></p>
                <form role="form" method="post" action="">
                    <?php
                    $userid = $_SESSION['userid'];
                    $ret = mysqli_query($con, "SELECT * FROM user WHERE ID='$userid'");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" type="text" value="<?php echo $row['FullName']; ?>"
                                   name="fullname" required="true">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="<?php echo $row['Email']; ?>" required="true" readonly="true">
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input class="form-control" type="text" value="<?php echo $row['MobileNumber']; ?>"
                                   required="true" name="contactnumber" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label>Registration Date</label>
                            <input class="form-control" name="regdate" type="text"
                                   value="<?php echo $row['RegDate']; ?>" readonly="true">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
                        </div>
                    <?php } ?>
                </form>
                <a href="index.php" class="back-button">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
