<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $total_copies = $_POST['total_copies'];
    $available_copies = $_POST['available_copies'];

    $sql = "Insert INTO books (title, author, isbn, total_copies, available_copies) VALUES ('$title', '$author', '$isbn', '$total_copies', '$available_copies')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error Adding record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <h1>Add Book</h1>
    <div class="form-wrapper">
        <div class="form">
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title"  required><br><br>
        <label>Author:</label>
        <input type="text" name="author"  required><br><br>
        <label>ISBN:</label>
        <input type="text" name="isbn"  required  title="Please enter a Valid Number"><br><br>
        <label>Total Copies:</label>
        <input type="number" name="total_copies" required  pattern="[0-9]" title="Please enter a Valid Number"><br><br>
        <label>Available Copies:</label>
        <input type="number" name="available_copies" required pattern="[0-9]" title="Please enter a Valid Number"><br><br>
        <button type="submit">Add Book</button>
    </form>
    </div>
    </div>
</body>
</html>
