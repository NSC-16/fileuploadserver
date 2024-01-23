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

// Retrieve data from the sign-in form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists in the 'users' table
$sql = "SELECT * FROM newg WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    header("Location: /Adcon/fu/str.php"); // Redirect to the index page after sign-up
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
// if (mysqli_num_rows($result) == 1) {
//     header("Location: signin_success.html"); // Redirect to sign-in success page
//     exit();
// } else {
//     echo "Invalid username or password.";
// }

// mysqli_close($conn);
?>
