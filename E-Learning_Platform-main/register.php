

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

// Process the registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $cpassword = password_hash($_POST['cpassword'], PASSWORD_BCRYPT);
       

    $sql = "INSERT INTO register (first_name, last_name, email, password, cpassword) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $password, $cpassword);

    if ($stmt->execute()) {
        echo "<script>
            alert('Registration successful!. Now You can go to login.');
            window.location.href = 'contact.html';
          </script>";
            exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
