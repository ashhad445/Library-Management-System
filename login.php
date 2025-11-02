<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $password = $_POST['password'];
    $role = $_POST['role'];

    if($role == 'admin') {
        $username = $_POST['username'];
        $sql = "select * from admins where username ='$username' and password ='$password'";
    } else {
        $email = $_POST['email'];
        $sql = "select * from members where email ='$email' and password ='$password'";
    }

    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        if($role == 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            header("Location: user_dashboard.php?id=" . $result->fetch_assoc()['member_id']);
            exit();
        }
    } else {
        echo "Invalid credentials. Please try again.";
        echo "<br>Redirecting back to dashboard in 3 seconds...";

        echo "<script>
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000); // 3000 milliseconds = 3 seconds
          </script>";
    exit();
    }
    $conn->close();
}
?>