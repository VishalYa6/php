<?php
$servername = "localhost";
$username = "";
$password = ;
$dbname = "personal_data";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed !". $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = $_POST["first_name"];
    $email = $_POST["email"];
    

    $first_name = $conn ->real_escape_string($first_name);
    $email = $conn ->real_escape_string($email);

    $sql = "INSERT INTO personal_info (first_name, email) VALUES('$first_name', '$email') ";

    if($conn->query($sql) === TRUE) {
        echo "New Record created sucessfully";
} else {
    echo "Error: ".$sql ."<br>".$conn->error;}

    $conn-> close();
}
?>