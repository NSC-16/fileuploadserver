<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log History</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include custom CSS for styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="log-history">
            <h1 class="mb-4">Log History</h1>
            <ul class="list-group">
                <?php
                // Connect to the database and retrieve log entries
                $servername = "localhost";
                $username = "root";
                $password = "admin"; // Set your database password here
                $dbname = "bizzconsult";

                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT file_name, upload_timestamp FROM file_uploads ORDER BY upload_timestamp DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item'>" . htmlspecialchars($row["file_name"]) . " (Uploaded at: " . htmlspecialchars($row["upload_timestamp"]) . ")</li>";
                    }
                } else {
                    echo "<li class='list-group-item'>No log entries found.</li>";
                }

                $conn->close();
                ?>
            </ul>
            <br>
            <a href="/Adcon/fu/str.php" class="btn btn-secondary">Back to File Upload Page</a>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
