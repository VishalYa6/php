<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>

<h2>Student Registration</h2>

<form action="register.php" method="post">
    <label for="reg_no">Registration Number:</label>
    <input type="text" id="reg_no" name="reg_no" required><br><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required><br><br>

    <label for="class">Class:</label>
    <input type="text" id="class" name="class" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="contact">Contact Number:</label>
    <input type="text" id="contact" name="contact" required><br><br>

    <input type="submit" name="submit" value="Register">
</form>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['submit'])) {
    // Get form data
    $reg_no = $_POST['reg_no'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Validation
    if (empty($reg_no) || empty($name) || empty($dob) || empty($class) || empty($email) || empty($contact)) {
        echo "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact)) {
        echo "Invalid contact number format!";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO students (reg_no, name, dob, class, email, contact) 
                VALUES ('$reg_no', '$name', '$dob', '$class', '$email', '$contact')";

        if ($conn->query($sql) === TRUE) {
            echo "Student registered successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

</body>
</html>
