<?php
//admin panel ma login garna laia session start gareko
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// admin pannel reset gareko yeha chai
?>

<?php
// Database connection gareko yo chai
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $allowed_categories = ['wedding', 'marketing', 'fashion'];

    if (in_array($category, $allowed_categories)) {
        if (isset($_FILES['photo'])) {
            $image = $_FILES['photo'];
            $fileName = $image['name'];
            $size = $image['size'];
            $fileTemp = $image['tmp_name'];
            $type = $image['type'];
            $size_converted = $size / 1048576;
            $date = date("Y-m-d-H-i-s");
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newfilename = $date . "." . $extension;

            if ($type == "image/jpeg" || $type == "image/png" || $type == "image/jpg") {
                if ($size_converted < 5) {
                    $upload_dir = 'images/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }
                    if (move_uploaded_file($fileTemp, $upload_dir . $newfilename)) {
                        $query = "INSERT INTO $category (image) VALUES ('$newfilename')";
                        if (mysqli_query($conn, $query)) {
                            echo "File uploaded successfully";
                        } else {
                            echo "Failed to upload file to database";
                        }
                    } else {
                        echo "Failed to move uploaded file";
                    }
                } else {
                    die("Error: File is too large");
                }
            } else {
                die("Error: File type not supported");
            }
        } else {
            echo "No file uploaded";
        }
    } else {
        echo "Invalid category selected";
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        nav {
            background-color: #333;
            padding: 10px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1.1rem;
        }
        nav ul li a:hover {
            color: #ccc;
        }
        main {
            padding: 20px;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"],
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #555;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-gray-200">
<header class="bg-gray-800 text-white p-4">
        <nav class="flex justify-between items-center">
            <h1 class="text-xl">Admin Panel</h1>
            <ul class="flex space-x-4">
                <li><a href="admin.php" class="text-white hover:text-gray-400">Upload Photos</a></li>
                <li><a href="manage_images.php" class="text-white hover:text-gray-400">Manage Images</a></li>
                <li><a href="manage_contacts.php" class="text-white hover:text-gray-400">Manage Contacts</a></li>
                <li><a href="content.php" class="text-white hover:text-gray-400">Manage Content</a></li>
                <li><a href="logout.php" class="text-white hover:text-gray-400">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main class="p-6">
        <h2 class="text-2xl mb-4">Upload Photos</h2>
        <!-- yo chai hamro Upload Form garako admin pannel bata edit upload delete garna lai -->
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label for="category" class="block text-gray-700 mb-2">Category:</label>
                <select id="category" name="category" class="w-full p-2 border rounded">
                    <option value="wedding">Wedding</option>
                    <option value="marketing">Marketing</option>
                    <option value="fashion">Fashion</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-gray-700 mb-2">Photo:</label>
                <input type="file" id="photo" name="photo" class="w-full p-2 border rounded">
            </div>
            <button type="submit" name="submit" class="bg-blue-500 text-white p-2 rounded">Upload</button>
        </form>
    </main>
</body>
</html>



