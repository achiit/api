<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "formtest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all user names from the database
$sql = "SELECT name, message FROM form_entries";
$result = $conn->query($sql);

$usersData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usersData[] = array("name" => $row["name"], "message" => $row["message"]);
    }
}

// Convert the data to JSON format
$usersJson = json_encode($usersData);

// Close the database connection
$conn->close();

// Output the JSON data
header('Content-Type: application/json');
echo $usersJson;
?>
