


<?php
include 'db.php';
include 'class.php';  // Include the User class

$action = $_POST['action'];
$user = new User($mysqli);  // Instantiate the User class

// Handle CRUD operations based on the action
if ($action == 'read') {
    $search = $_POST['search'] ?? '';
    $users = $user->read($search);

    // Display users in table format
    echo "<table class='table table-bordered'>
            <thead><tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Phone</th><th>City</th><th>Actions</th></tr></thead><tbody>";
    foreach ($users as $row) {
        echo "<tr>
          <td>{$row['id']}</td>
          <td>".htmlspecialchars($row['firstname'])."</td>
          <td>".htmlspecialchars($row['lastname'])."</td>
          <td>".htmlspecialchars($row['emailaddress'])."</td>
          <td>".htmlspecialchars($row['phone'])."</td>
          <td>".htmlspecialchars($row['city'])."</td>
          <td>
            <button class='btn btn-sm btn-info editBtn' data-id='{$row['id']}'>Edit</button>
            <button class='btn btn-sm btn-danger deleteBtn' data-id='{$row['id']}'>Delete</button>
          </td>
        </tr>";
    }
    
    echo "</tbody></table>";
    echo "<button onclick='window.history.back();' class='btn btn-secondary'>Go Back</button>";
     
} elseif ($action == 'create' || $action == 'update') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['emailaddress'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    if ($action == 'create') {
        $user->create($firstname, $lastname, $email, $password, $phone, $city);
    } else {
        $id = $_POST['id'];
        $user->update($id, $firstname, $lastname, $email, $password, $phone, $city);
    }

} elseif ($action == 'get') {
    $id = $_POST['id'];
    $userData = $user->get($id);
    echo json_encode($userData);

} elseif ($action == 'delete') {
    $id = $_POST['id'];
    $user->delete($id);
}
?>
