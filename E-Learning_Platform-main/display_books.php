<!DOCTYPE html>
<html>

<head>

    <style>
        .book-container {
            border: 2px solid #ccc;
            padding: 30px;
            margin: 24px;
            margin-left: 26px;
            /* text-align: center; */
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 2px 2px 4px #888888;
        }

        .book-container h2  {
            font-size: 1.5rem;
            margin: 14px 10;
        }
        h1{
            margin-left: 520px;
        }

        .book-container p {
            font-size: 1rem;
            width:auto;
            margin: 10px 6px;
        }

        .download-button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .download-button:hover {
            background-color: #0056b3;
        }

        .search-container {
            margin: 20px;
    
            margin-left: 30px;
        }

        .search-container input[type="text"] {
            padding: 6px;
            width: 260px;
            border-radius: 4px;
        }

        .search-container button {
            padding: 6px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            width: 80px;
            height: 30px;
            margin-left: 10px;
            border-radius: 4px;
        }
    </style>

    <title>Book Store</title>
</head>

<body>
    <h1>List of Books :</h1>

    <div class="search-container">
        <form method="post">
            <input type="text" name="search" placeholder="     Search by Title, Writer, or Description   ">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "book_store");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        // Query to retrieve book data from the database with search filter
        $sql = "SELECT id, filename, writer_name, description FROM books 
                WHERE filename LIKE '%$search%' 
                OR writer_name LIKE '%$search%' 
                OR description LIKE '%$search%'";
    } else {
        // Query to retrieve all books if no search query
        $sql = "SELECT id, filename, writer_name, description FROM books";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdfId = $row['id'];
            $pdfFilename = $row['filename'];
            $pdfWriter = $row['writer_name'];
            $pdfDescription = $row['description'];

            // Display book information and provide download links
            echo "<div class='book-container'>
            <h2>Book Title: $pdfFilename</h2>
            <p>Writer Name: $pdfWriter</p>
            <p>Description: $pdfDescription</p>    
            <form action='books_pdf/$pdfFilename' method='get'>
                <button class='download-button' type='submit'>Download PDF</button>
            </form>
        </div><br>";
        }
    } else {
        echo "No books available.";
    }

    $conn->close();
    ?>
</body>

</html>
