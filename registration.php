<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $password = $_POST['password'];
    $email = strtolower(trim($_POST['emailaddress']));
    $phone = trim($_POST['phone']);
    $city = trim($_POST['city']);

    // Validate empty fields
    if (empty($firstname) || empty($lastname) || empty($password) || empty($email) || empty($phone) || $city === '') {
        echo "<script>
                alert('All fields are required.');
                window.history.back();
              </script>";
        exit();
    }






    $checkQuery = $conn->prepare("SELECT emailaddress, phone FROM users WHERE emailaddress = ? OR phone = ?");
    $checkQuery->bind_param("ss", $email, $phone);
    $checkQuery->execute();
    $checkQuery->store_result();

    if ($checkQuery->num_rows > 0) 
        {
        // Fetch the existing values
        $checkQuery->bind_result($existing_email, $existing_phone);
        $checkQuery->fetch();

        if ($email === $existing_email)
             {
            echo "<script>
                    alert('This email address is already registered.');
                    window.history.back();
                  </script>";
        } elseif ($phone === $existing_phone)
         {
            echo "<script>
                    alert('This phone number is already registered.');
                    window.history.back();
                  </script>";
        } else {
            echo "<script>
                    alert('Email or phone already registered.');
                    window.history.back();
                  </script>";
        }

        $checkQuery->close();
        exit();
    }
    $checkQuery->close();






  




   




       

    
 $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insert = $conn->prepare("INSERT INTO users (firstname, lastname, password, emailaddress, phone, city) VALUES (?, ?, ?, ?, ?, ?)");
    $insert->bind_param("ssssss", $firstname, $lastname, $hashedPassword, $email, $phone, $city);

    if ($insert->execute()) {
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'demo1.php';
              </script>";
    } else {
        echo "<script>
                alert('Registration failed. Please try again.');
                window.history.back();
              </script>";
    }

    $insert->close();
}

$conn->close();
?>
