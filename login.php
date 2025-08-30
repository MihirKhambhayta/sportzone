<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        
    $firstname = trim($_POST['firstname']);
    $password = $_POST['password'];

    if (empty($firstname) || empty($password))
         {
        echo " Username and password are required.";
    } 
    else
     {
        $stmt = $conn->prepare("SELECT password FROM users WHERE firstname = ?");
        $stmt->bind_param("s", $firstname, );
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) 
            {


             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $str=password_verify($password, $hashed_password);

             echo "<script>
                    alert($str);
                    window.history.back();
                  </script>";

            if (password_verify($password, $hashed_password)) 
               
                {
                $_SESSION['firstname'] = $firstname;
                header("Location: dashboard.php");
                exit();
            } 
            
            else
             {
                 echo "<script>
                    alert('❌ Incorrect password.');
                    window.history.back();
                  </script>";

                
            }
        } else 
        {
             echo "<script>
                    alert('❌ User Not Found.');
                    window.history.back();
                  </script>";

        }

         

        $stmt->close();
    }
}

$conn->close();
?>
