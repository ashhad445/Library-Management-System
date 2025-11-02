<?php

include 'db.php';

$id = $_GET['id'];
$type = $_GET['type'];

if ($type == 'book') {
    $sql = "DELETE FROM books WHERE book_id='$id'";
} elseif ($type == 'member') {
    $sql = "DELETE FROM members WHERE member_id='$id'";
} else {
    echo "Invalid type specified.";
    exit();
}

if ($conn->query($sql)) {
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}


?>