<?php
require './database.php';
//database connection
if ($conn->connect_error) {
    die('Connection failed : ' . $conn->connect_error);
    return;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //$hash_password = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($passwordfromdatabase);
    $query=mysqli_query($conn, "insert into tblexpense(UserId,ExpenseDate,ExpenseItem,ExpenseCost) value('$userid','$dateexpense','$item','$costitem')");

    // if ($stmt->execute()) {
    //     echo "Data inserted successfully.";
    // } else {
    //     echo "Error inserting data: " . $stmt->error;
    // }

    if ($stmt->fetch()) {
        // The query returned a result
        if (password_verify($password, $passwordfromdatabase)) {
            // Passwords match
            echo "Password is correct.";
            $stmt->close();
            // Delete the user
            $stmtdelete = $conn->prepare("DELETE FROM user WHERE email = ?");
            $stmtdelete->bind_param("s", $email);
            $stmtdelete->execute();
            $stmtdelete->close();
            echo "User deleted successfully.";
        } else {
            // Passwords do not match
            echo "Password is incorrect.";
        }
    } else {
        // No matching row found
        echo "User not found.";
    }
    
    
   
}
