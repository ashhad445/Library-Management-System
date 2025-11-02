<?php

include 'db.php';

$id = $_GET['id'];

$sqlBooks = "SELECT * FROM books";
$sqlBorrowed = "SELECT * FROM borrow_records WHERE member_id = '$id'";

$search = $_GET['search'] ?? '';

if($search){
    $sqlBooks = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR isbn LIKE '%$search%'";
}

$books = $conn->query($sqlBooks);
$borrowedRecords = $conn->query($sqlBorrowed);

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="logout.css">
    <title>Admin Dashboard</title>
</head>
<body>

    <nav>
        <div class="top-bar">
            <a href="index.php" class="logout-link">Logout</a>
        </div>
    </nav>

    <h1>Dashboard</h1>

    <div class="display-tables">

    <h2>Available Books</h2>

    <div class="search-bar">
    <form method="GET">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="text" id="searchInput" name="search" placeholder="Search..." value="<?php echo $_GET['search'] ?? '' ?>">
        <button type="submit">Search</button>
    </form>
    </div>
    <div class="table-wrapper">
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Available Copies</th>
            <th>Action</th>
        </tr>
        <?php while($row = $books->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['book_id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['isbn']; ?></td>
            <td><?php echo $row['available_copies']; ?></td>
            <td>
                <a href="borrow_book.php?book_id=<?php echo $row['book_id']; ?>&member_id=<?php echo $id; ?>" class = "table-btn">Borrow</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
    </div>
    </div>

    
    <div class="display-tables">
    <h2>Your Borrowed Books</h2>
    <table>
        <tr>
            <th>Record ID</th>
            <th>Book ID</th>
            <th>Member ID</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $borrowedRecords->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['borrow_id']; ?></td>
            <td><?php echo $row['book_id']; ?></td>
            <td><?php echo $row['member_id']; ?></td>
            <td><?php echo $row['issue_date']; ?></td>
            <td><?php echo $row['due_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="return_book.php?borrow_id=<?php echo $row['borrow_id']; ?>&member_id=<?php echo $id; ?>" class = "table-btn">Mark as Returned</a>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>

</body>
</html>