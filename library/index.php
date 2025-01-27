<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Change to your MySQL username
$password = "";  // Change to your MySQL password
$dbname = "library";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$membership_id = $name = $address = $phone_number = $email = "";
$membership_id_err = $name_err = $address_err = $phone_number_err = $email_err = "";

// Handle form submission (registration)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Membership ID
    if (empty($_POST["membership_id"])) {
        $membership_id_err = "Membership ID is required";
    } else {
        $membership_id = $_POST["membership_id"];
    }

    // Validate Name
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    } else {
        $name = $_POST["name"];
    }

    // Validate Address
    if (empty($_POST["address"])) {
        $address_err = "Address is required";
    } else {
        $address = $_POST["address"];
    }

    // Validate Phone Number
    if (empty($_POST["phone_number"])) {
        $phone_number_err = "Phone number is required";
    } else {
        $phone_number = $_POST["phone_number"];
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }

    // If no errors, insert data into the database
    if (empty($membership_id_err) && empty($name_err) && empty($address_err) && empty($phone_number_err) && empty($email_err)) {
        $sql = "INSERT INTO members (membership_id, name, address, phone_number, email)
                VALUES ('$membership_id', '$name', '$address', '$phone_number', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "New member registered successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle issued books retrieval based on membership ID
$books_issued = [];
if (isset($_GET["membership_id"])) {
    $membership_id = $_GET["membership_id"];
    $sql = "SELECT b.book_title, b.author, ib.issue_date, ib.return_date
            FROM issued_books ib
            JOIN books b ON ib.book_id = b.id
            WHERE ib.membership_id = '$membership_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books_issued[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Member Registration</title>
</head>
<body>
    <h1>Library Member Registration</h1>

    <!-- Member Registration Form -->
    <form action="index.php" method="POST">
        Membership ID: <input type="text" name="membership_id" value="<?php echo $membership_id; ?>">
        <span><?php echo $membership_id_err; ?></span><br><br>

        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span><?php echo $name_err; ?></span><br><br>

        Address: <textarea name="address"><?php echo $address; ?></textarea>
        <span><?php echo $address_err; ?></span><br><br>

        Phone Number: <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
        <span><?php echo $phone_number_err; ?></span><br><br>

        Email: <input type="email" name="email" value="<?php echo $email; ?>">
        <span><?php echo $email_err; ?></span><br><br>

        <input type="submit" value="Register">
    </form>

    <h2>Books Issued to Member</h2>
    <form action="index.php" method="GET">
        Enter Membership ID to View Issued Books: <input type="text" name="membership_id" value="<?php echo $membership_id; ?>">
        <input type="submit" value="View Books">
    </form>

    <?php if (!empty($books_issued)): ?>
        <h3>Books Issued:</h3>
        <table border="1">
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Issue Date</th>
                <th>Return Date</th>
            </tr>
            <?php foreach ($books_issued as $book): ?>
                <tr>
                    <td><?php echo $book["book_title"]; ?></td>
                    <td><?php echo $book["author"]; ?></td>
                    <td><?php echo $book["issue_date"]; ?></td>
                    <td><?php echo $book["return_date"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
