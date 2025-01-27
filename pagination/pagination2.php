<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "personal_data";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS personal_data";
if ($conn->query($sql) === TRUE) {
    // Database created successfully or already exists
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database to work with
$conn->select_db($dbname);

// Step 2: Create the personal_info table if it doesn't exist
$table_sql = "CREATE TABLE IF NOT EXISTS personal_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address TEXT,
    pincode VARCHAR(10)
)";

if ($conn->query($table_sql) === TRUE) {
    // Table created successfully or already exists
} else {
    echo "Error creating table: " . $conn->error;
}

// Step 3: Insert sample data if the table is empty
$result = $conn->query("SELECT COUNT(*) AS total FROM personal_info");
$row = $result->fetch_assoc();
if ($row['total'] == 0) {
    // Insert some sample data if the table is empty
    $insert_sql = "INSERT INTO personal_info (first_name, last_name, email, address, pincode)
    VALUES
    ('John', 'Doe', 'john.doe@example.com', '123 Elm Street', '12345'),
    ('Jane', 'Smith', 'jane.smith@example.com', '456 Oak Avenue', '67890'),
    ('Alice', 'Johnson', 'alice.johnson@example.com', '789 Pine Road', '11223'),
    ('Bob', 'Brown', 'bob.brown@example.com', '101 Maple Blvd', '44556'),
    ('Charlie', 'Davis', 'charlie.davis@example.com', '202 Birch Drive', '77889'),
    ('David', 'Miller', 'david.miller@example.com', '303 Cedar Lane', '99100'),
    ('Eva', 'Wilson', 'eva.wilson@example.com', '404 Willow Circle', '22334')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Sample data inserted successfully.";
    } else {
        echo "Error inserting sample data: " . $conn->error;
    }
}

// Pagination logic
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$limit = 5;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM personal_info LIMIT $start, $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr> 
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Pin Code</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                 <td>" . $row["first_name"] . "</td>
                 <td>" . $row["last_name"] . "</td>
                 <td>" . $row["email"] . "</td>
                 <td>" . $row["address"] . "</td>
                 <td>" . $row["pincode"] . "</td>
                </tr>";
    }
    echo "</table>";
} else {
    echo "NO RESULTS FOUND";
}

// Get the total number of rows to calculate total pages
$total_sql = "SELECT COUNT(*) AS total FROM personal_info";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_rows = (int)$total_row['total'];

$total_pages = ceil($total_rows / $limit);

echo "<br>Page: $page<br>";
echo "Total Pages: $total_pages<br><br><br>";

// Display Previous Button
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "' style='padding:10px 20px; background-color:#007BFF; color:white; text-decoration:none; border-radius:5px;'>Previous</a> ";
} else {
    echo "<span style='padding:10px 20px; background-color:#ccc; color:white; border-radius:5px;'>Previous</span> ";
}

// Display Next Button
if ($page < $total_pages) {
    echo "<a href='?page=" . ($page + 1) . "' style='padding:10px 20px; background-color:#007BFF; color:white; text-decoration:none; border-radius:5px;'>Next</a>";
} else {
    echo "<span style='padding:10px 20px; background-color:#ccc; color:white; border-radius:5px;'>Next</span>";
}

// Close the connection
$conn->close();
?>
