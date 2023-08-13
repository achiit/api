<?php
// Establish database connection
$servername = "achintyatest.database.windows.net";
$username = "achintya";
$password = "Jaishreeram@123";
$dbname = "formtest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert data into the table
$sql = "INSERT INTO form_entries (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    // Data submitted successfully, redirect to the page showing all users
    header("Location: show_users.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>