<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Information</title>
</head>
<body>

<h2>Search Student by Registration Number</h2>

<form action="view_student.php" method="post">
    <label for="reg_no">Enter Registration Number:</label>
    <input type="text" id="reg_no" name="reg_no" required><br><br>

    <input type="submit" name="submit" value="Search">
</form>

<?php
if (isset($_POST['submit'])) {
    $reg_no = $_POST['reg_no'];

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

    // Retrieve student information based on REG_NO
    $sql = "SELECT * FROM students WHERE reg_no = '$reg_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output student data in a table
        while($row = $result->fetch_assoc()) {
            echo "<h3>Student Information</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>Registration Number</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Class</th>
                        <th>Email</th>
                        <th>Contact</th>
                    </tr>
                    <tr>
                        <td>" . $row['reg_no'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['dob'] . "</td>
                        <td>" . $row['class'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['contact'] . "</td>
                    </tr>
                  </table>";
        }
    } else {
        echo "No student found with this Registration Number.";
    }

    $conn->close();
}
?>

</body>
</html>
