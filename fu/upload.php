<?php
$targetDirectory = "uploads/"; // Directory to store uploaded files
$allowedExtensions = ["xls", "csv", "txt"]; // Allowed file extensions

if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true); // Create directory if it doesn't exist
}

$targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// Check file extension
$fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedExtensions)) {
    // Display an error message
    echo '<script type="text/javascript">
            alert("Sorry, only .xls, .csv, and .txt files are allowed.");
            window.location = "/Adcon/fu/str.php";
          </script>';
    $uploadOk = 0;
}

if (isset($_POST["submit"]) && $uploadOk) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        // Display a success message
        echo '<script type="text/javascript">
            alert("The file ' . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . ' has been uploaded.");
            window.location = "/Adcon/fu/str.php";
          </script>';
        
        // Log the file upload event with timestamp
        $logMessage = "File uploaded: " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " (Uploaded at: " . date("Y-m-d H:i:s") . ")";
        file_put_contents("log.txt", $logMessage . PHP_EOL, FILE_APPEND | LOCK_EX);
        
        // Connect to the database and store the log entry
        $servername = "localhost";
        $username = "root";
        $password = "admin"; // Set your database password here
        $dbname = "bizzconsult";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO file_uploads (file_name, upload_timestamp) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $file_name, $upload_timestamp);
        
        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $upload_timestamp = date("Y-m-d H:i:s");
        
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } else {
        // Display an error message
        echo '<script type="text/javascript">
            alert("Sorry, there was an error uploading your file.");
            window.location = "/Adcon/fu/str.php";
          </script>';
    }
}
?>
