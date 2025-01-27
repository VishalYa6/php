<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
</head>
<body>

<h2>View Issued Books</h2>

<form action="issued_books.php" method="post">
    <label for="membership_id">Enter Membership ID:</label>
    <input type="text" id="membership_id" name="membership_id" required><br><br>

    <input type="submit" name="submit" value="View Issued Books">
</form>

<?php
if (isset($_POST['submit'])) {
    $membership_id = $_POST['membership_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve issued books based on membership_id
    $sql = "SELECT * FROM issued_books WHERE membership_id = '$membership_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Books Issued:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Book Title</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['book_title'] . "</td>
                    <td>" . $row['issue_date'] . "</td>
                    <td>" . $row['return_date'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No books found for this membership ID.";
    }

    $conn->close();
}
?>

</body>
</html>
