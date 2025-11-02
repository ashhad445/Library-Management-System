<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Passwords do not match.";
        echo "Going back to Login page...";
        sleep(3);
        header("Location: index.php");
        exit();
    }

    $sql =  "Insert INTO members (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful.";
        echo "Going back to Login page...";
        sleep(3);
        header("Location: index.php");
        exit();
    } else {
        echo "Error Adding record: " . $conn->error;
    }
    $conn->close();
}

?>