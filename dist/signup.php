<?php
$server = "localhost"; // Server name (XAMPP default: localhost)
$username = "root"; // Your MySQL username
$password = "admin"; // Your MySQL password
$database = "bizzconsult"; // Your database name

// Create a connection
$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the sign-up form
$username = $_POST['username'];
$password = $_POST['password'];

// Insert user data into the 'users' table
$sql = "INSERT INTO newg (username, password) VALUES ('$username', '$password')";

if (mysqli_query($conn, $sql)) {
    header("Location: /Adcon/fu/str.php"); // Redirect to the index page after sign-up
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
