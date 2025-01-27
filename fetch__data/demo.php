<?php
$servername = "localhost";
$username = "";
$password = ;
$dbname = "personal_data";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed". $conn->connect_error);
}
$sql = "SELECT  first_name, last_name , email , address , pincode FROM personal_info";
$result = $conn->query($sql);

echo "<table  border = '1' cellpadding='5', cellspacing='0'>";
echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Address</th><th>Pincode</th></tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" .$row["first_name"] . "</td>";
        echo "<td>" .$row["last_name"] . "</td>";
        echo "<td>" .$row["email"] . "</td>";
        echo "<td>" .$row["address"] . "</td>";
        echo "<td>" .$row["pincode"] . "</td>";
        echo "</tr>";
    }
} else { 
    echo "0 results";
}

echo "</table>";
$conn -> close();
?>