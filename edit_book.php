<?php

include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM books WHERE book_id='$id'");
$row = $result->fetch_assoc();

$book_id = $row['book_id'];
$title = $row['title'];
$author = $row['author'];
$isbn = $row['isbn'];
$total_copies = $row['total_copies'];
$available_copies = $row['available_copies'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $total_copies = $_POST['total_copies'];
    $available_copies = $_POST['available_copies'];

    $sql = "UPDATE books SET title='$title', author='$author', isbn='$isbn', total_copies='$total_copies', available_copies='$available_copies' WHERE book_id='$book_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
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
    <h1>Update Book Information</h1>
    <div class="form-wrapper">
        <div class="form">
    <form method="POST"]>
        <input type="hidden" name="book_id" value="<?php echo $id; ?>">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $title ?>" required><br><br>
        <label>Author:</label>
        <input type="text" name="author" value="<?php echo $author ?>" required><br><br>
        <label>ISBN:</label>
        <input type="text" name="isbn" value="<?php echo $isbn ?>" required><br><br>
        <label>Total Copies:</label>
        <input type="number" name="total_copies" value="<?php echo $total_copies ?>" required><br><br>
        <label>Available Copies:</label>
        <input type="number" name="available_copies" value="<?php echo $available_copies ?>" required><br><br>
        <button type="submit">Update Book</button>
    </form>
    </div>
    </div>
</body>
</html>