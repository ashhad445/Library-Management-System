<?php

include 'db.php';

$id = $_GET['member_id'];
$book_id = $_GET['book_id'];

$sql = "INSERT INTO borrow_records (book_id, member_id, issue_date, due_date, status) VALUES ('$book_id', '$id', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 MONTH), 'Borrowed')";

if ($conn->query($sql) === TRUE) {
    
    $updateSql = "UPDATE books SET available_copies = available_copies-1 WHERE book_id='$book_id'";
    $conn->query($updateSql);

    header("Location: user_dashboard.php?id=" . $id);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>