<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Member Registration</title>
</head>
<body>

<h2>Library Member Registration</h2>

<form action="register.php" method="post">
    <label for="membership_id">Membership ID:</label>
    <input type="text" id="membership_id" name="membership_id" required><br><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <input type="submit" name="submit" value="Register">
</form>

<?php
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

if (isset($_POST['submit'])) {
    // Get form data
    $membership_id = $_POST['membership_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Validate input
    if (empty($membership_id) || empty($name) || empty($address) || empty($phone) || empty($email)) {
        echo "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "Invalid phone number format!";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO members (membership_id, name, address, phone, email)
                VALUES ('$membership_id', '$name', '$address', '$phone', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

</body>
</html>
