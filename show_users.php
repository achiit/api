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

// Fetch all user names from the database
$sql = "SELECT name, message  FROM form_entries";
$result = $conn->query($sql);

$usersData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usersData[] = array("name" => $row["name"], "message" => $row["message"]);
    }
}
if (isset($_GET['delete'])) {
    // Handle delete request
    $nameToDelete = $_GET['delete'];
    $sql = "DELETE FROM form_entries WHERE name='$nameToDelete'";
    $conn->query($sql);
    header("Location: show_users.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        #container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            scroll-behavior: smooth;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 40px auto;
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
        }

        a {
            color: #007bff;
            text-decoration: none;
            padding-left: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-users {
            text-align: center;
            color: #666;
            padding: 20px;
        }

        .form-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
        }

        li span {
            flex: 1;
        }

        .user-name {
            font-weight: bold;
        }

        .form-btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .user-message {
            font-weight: bold;
            flex: 2;



            text-align: right;
            padding-right: 60px;
        }
    </style>
    <!-- Add any desired styling for the users list page here -->
</head>

<body>
    <div id="container">
        <h1>Users List</h1>
        <?php
        if (count($usersData) > 0) {
            echo "<ul>";
            echo "<li><span class='user-name'>Name</span> <span class='user-message'>Message</span></li>";
            foreach ($usersData as $userData) {
                echo "<li><span>" . htmlspecialchars($userData['name']) . "</span> " . htmlspecialchars($userData['message']) . "</span> <a href='show_users.php?delete=" . urlencode($userData['name']) . "'>Delete</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No users found in the database.</p>";
        }
        ?>
        <div class="form-btn-container">
            <a href="index.html" class="form-btn">Create new user</a>
        </div>
    </div>
</body>

</html>
