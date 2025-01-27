<?php 
$servername = "localhost";
$username = "";
$password = ;
$dbname = "personal_data";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed!!!". $conn->connect_error);
}
$page = isset( $_GET["page"] ) ? (int)$_GET["page"] :1;

$limit = 5;
$start = ($page -1) * $limit;

$sql = "SELECT * FROM personal_info LIMIT $start , $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo"<table border='1'>
            <tr> 
                <th>First Name</th>
                <th>Last  Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Pin Code</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                 <td>". $row["first_name"] ."</td>
                 <td>" . $row["last_name"] . "</td>
                 <td>" . $row["email"] . "</td>
                 <td>" . $row["address"] . "</td>
                 <td>" . $row["pincode"] . "</td>
                </tr>";

}
echo "</table>" ;
} else {
    echo "NO RESULTS FOUND";
}


$total_sql = "SELECT COUNT(*) AS total FROM personal_info";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_rows = (int)$total_row['total'];

$total_pages = ceil($total_rows / $limit);


echo "<br>Page: $page<br>";
echo "Total Pages: $total_pages<br><br><br>";
// Display Previous Button
if ($page > 1) {
    // Build the URL for the Previous page
    echo "<a href='?page=" . ($page - 1) . "' style='padding:10px 20px; background-color:#007BFF; color:white; text-decoration:none; border-radius:5px;'>Previous</a> ";
} else {
    echo "<span style='padding:10px 20px; background-color:#ccc; color:white; border-radius:5px;'>Previous</span> ";
}

// Display Next Button
if ($page < $total_pages) {
    // Build the URL for the Next page
    echo "<a href='?page=" . ($page + 1) . "' style='padding:10px 20px; background-color:#007BFF; color:white; text-decoration:none; border-radius:5px;'>Next</a>";
} else {
    echo "<span style='padding:10px 20px; background-color:#ccc; color:white; border-radius:5px;'>Next</span>";
}
$conn -> close();
?>