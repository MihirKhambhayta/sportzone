<?php
// Include database connection
include 'db.php';

class User
 {
    private $mysqli;

    // Constructor to initialize the database connection
    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    // Create new user
    public function create($firstname, $lastname, $email, $password, $phone, $city) {
        $stmt = $this->mysqli->prepare("INSERT INTO users (firstname, lastname, emailaddress, password, phone, city) VALUES (?, ?, ?, ?, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $passwordHash, $phone, $city);
        $stmt->execute();
        $stmt->close();
    }

    // Read users based on a search query
    public function read($search = '')
     {
        $search = $this->mysqli->real_escape_string($search);
        $sql = "SELECT * FROM users WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR emailaddress LIKE '%$search%' OR phone LIKE '%$search%' OR city LIKE '%$search%' ORDER BY id DESC";
        $res = $this->mysqli->query($sql);

        $users = [];
        while ($row = $res->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    // Get user details by ID
    public function get($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }

    // Update user information
    public function update($id, $firstname, $lastname, $email, $password, $phone, $city) {
        $stmt = $this->mysqli->prepare("UPDATE users SET firstname=?, lastname=?, emailaddress=?, password=?, phone=?, city=? WHERE id=?");
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $passwordHash, $phone, $city, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Delete a user by ID
    public function delete($id) {
        $stmt = $this->mysqli->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
