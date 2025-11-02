<?php

include 'db.php';
$id = $_GET['member_id'];
$borrow_id = $_GET['borrow_id'];

$sqlCheck = "SELECT * FROM borrow_records WHERE borrow_id='$borrow_id'";

$resultCheck = $conn->query($sqlCheck);
$borrowed = $resultCheck->fetch_assoc()['status'];

if($borrowed != 'Borrowed'){
    echo "This book has already been returned.";
    echo "<br>Redirecting back to dashboard in 3 seconds...";

    echo "<script>
            setTimeout(function() {
                window.location.href = 'user_dashboard.php?id=" . $id . "';
            }, 3000); // 3000 milliseconds = 3 seconds
          </script>";
    exit();
}

$sql = "UPDATE borrow_records SET status='Returned', return_date= CURDATE() WHERE borrow_id='$borrow_id'";

if ($conn->query($sql) === TRUE) {

    $getBookSql = "SELECT book_id FROM borrow_records WHERE borrow_id='$borrow_id'";
    
    $getBook = $conn->query($getBookSql);
    $book_id = $getBook->fetch_assoc()['book_id'];

    $updateSql = "UPDATE books SET available_copies = available_copies+1 WHERE book_id='$book_id'";
    $conn->query($updateSql);

    header("Location: user_dashboard.php?id=" . $id);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}