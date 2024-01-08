

<?php
// Establish a MySQL database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'course_database';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'];
		$email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
       

    $sql = "INSERT INTO course_register (fullname , email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fullname, $email, $password);

    if ($stmt->execute()) {
        // Registration was successful
        echo "<script>
                alert('Registration successful!. You can now log in to access the Free Courses.');
                window.location.href = 'index.html';
              </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    

    $stmt->close();
}

$conn->close();
?>
