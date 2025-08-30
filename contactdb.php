<?php
// contactdb.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Process the form data (e.g., save to database or send email)
    // Assuming you want to store this in a database (change as per your logic)

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db';

    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Check if the insert was successful
    if ($stmt->execute()) {
        // Return success response
        echo "success";
    } else {
        // Return error response
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
