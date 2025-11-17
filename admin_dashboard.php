<?php

include 'db.php';

$sqlBooks = "SELECT * FROM books";
$sqlMembers = "SELECT * FROM members";
$sqlBorrowed = "SELECT * FROM borrow_records";

$search = $_GET['search'] ?? '';

if($search){
    $sqlBooks = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR isbn LIKE '%$search%'";
}

$books = $conn->query($sqlBooks);
$members = $conn->query($sqlMembers);
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

    <h1>Admin Dashboard</h1>

    <div class="display-tables">

    <div class="search-bar">
    <form method="GET">
        <input type="text" id="searchInput" name="search" placeholder="Search..." value="<?php echo $_GET['search'] ?? '' ?>">
        <button type="submit">Search</button>
    </form>
    </div>

    <h2>Books</h2>
    <div class="table-wrapper">
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Total Copies</th>
            <th>Available Copies</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $books->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['book_id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['isbn']; ?></td>
            <td><?php echo $row['total_copies']; ?></td>
            <td><?php echo $row['available_copies']; ?></td>
            <td>
                <a href="edit_book.php?id=<?php echo $row['book_id']; ?>" class = "table-btn">Edit</a> |
                <a href="delete.php?id=<?php echo $row['book_id']; ?>&type=book" onclick="return confirm('Are you sure you want to delete this book?');" class = "table-btn">Delete</a>
        </tr>
        <?php endwhile; ?>

    </table>
    </div>
    <br>
    <button><a href="add_book.php" class = "table-btn">Add New Book</a></button>
    </div>

    <div class="display-tables">
    <h2>Members</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $members->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['member_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <a href="delete.php?id=<?php echo $row['member_id']; ?>&type=member" onclick="return confirm('Are you sure you want to delete this member?');" class = "table-btn">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>

    <div class="display-tables">
    <h2>Borrowed Books</h2>
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
                <a href="return_book.php?borrow_id=<?php echo $row['borrow_id']; ?>" class = "table-btn">Mark as Returned</a>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>


    
</body>
</html>