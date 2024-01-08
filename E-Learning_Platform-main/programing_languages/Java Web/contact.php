<?php
// Establish a database connection (you need to provide your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["date_of_birth"];
    $contact = $_POST["contact"];
    $accepted_terms_and_conditions = isset($_POST["cheakbox"]) ? 1 : 0;

    // Insert data into the database
    $sql = "INSERT INTO user_registration (username, password, email, gender, date_of_birth, contact, accepted_terms_and_conditions)
            VALUES ('$username', '$password', '$email', '$gender', '$date_of_birth', '$contact', '$accepted_terms_and_conditions')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
