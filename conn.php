<?php
$host = "mysql";  // This should match the MySQL service name in docker-compose.yml
$user = "myuser";
$password = "mypassword";
$database = "mydatabase";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
