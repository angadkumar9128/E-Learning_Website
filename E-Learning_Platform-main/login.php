<?php
// Establish a MySQL database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_database';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT email, password FROM register WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct
            echo "<script>
            alert('Login successful!. Now You can access our Courses. ');
            window.location.href = '/webdevlopementproject/E-Learning_Platform-main/index.html';
          </script>";            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }

    $stmt->close();
}

$conn->close();
?>
