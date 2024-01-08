<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdfWriter = $_POST['writerName'];
    $description = $_POST['description'];

    $uploadDir = 'books_pdf/'; // Create an 'uploads' directory to store PDFs
    $uploadFile = $uploadDir . basename($_FILES['pdfFile']['name']);

    if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
        // File uploaded successfully; insert data into the database
        $conn = new mysqli("localhost", "root", "", "book_store");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $pdfFilename = basename($_FILES['pdfFile']['name']);
        $sql = "INSERT INTO books (filename, writer_name, description) VALUES ('$pdfFilename', '$pdfWriter', '$description')";

        if ($conn->query($sql) === TRUE) {
            header("Location:display_books.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "File upload failed.";
    }
}
?>
