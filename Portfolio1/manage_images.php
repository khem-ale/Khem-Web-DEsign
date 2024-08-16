<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$categories = ['wedding_images', 'marketing_images', 'fashion_images'];

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    
    if (in_array($category, $categories)) {
        // image fetch gareko database bata
        $query = "SELECT image FROM $category WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $imagePath = 'pics/' . $row['image']; //path set gareko

            // image file delete gareko server bata
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // image ko record delete gareko database bata
            $deleteQuery = "DELETE FROM $category WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $id);
            if ($deleteStmt->execute()) {
                echo "Image deleted successfully.";
            } else {
                echo "Error deleting image from database: " . $deleteStmt->error;
            }
            $deleteStmt->close();
        } else {
            echo "No image found for ID $id in category $category";
        }
        $stmt->close();
    } else {
        echo "Invalid category.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Manage Images</title>
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
        .img-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .img-container img {
            max-width: 150px;
            border-radius: 5px;
        }
        .img-container div {
            position: relative;
            display: inline-block;
        }
        .img-container .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-200">

    <header class="bg-gray-800 text-white p-4">
        <h1 class="text-xl">Manage Images</h1>
    </header>

    <main class="p-6">
        <h2 class="text-2xl mb-4">Manage Images</h2>
        <nav>
            <ul>
            <li><a href="admin.php">Upload Photos</a></li>
            <li><a href="manage_images.php">Manage Images</a></li>
            <li><a href="manage_contacts.php">Manage Contacts</a></li>
            <li><a href="content.php">Manage Contents</a></li>
            </ul>
        </nav>

        <div class="content">
            <?php foreach ($categories as $category): ?>
                <h3 class="text-xl mt-4 mb-2"><?= ucfirst(str_replace('_images', '', $category)) ?> Images</h3>
                <div class="img-container">
                    <?php
                    $query = "SELECT id, image FROM $category";
                    $result = $conn->query($query);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $imagePath = 'pics/' . $row['image']; //path set gareko
                                ?>
                                <div>
                                    <img src="<?= $imagePath ?>" alt="Image">
                                    <form action="manage_images.php" method="POST" class="absolute top-0 right-0">
                                        <input type="hidden" name="category" value="<?= $category ?>">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete" class="delete-btn">X</button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No images found in $category.";
                        }
                    } else {
                        echo "Query failed: " . $conn->error;
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>

</html>

<?php
$conn->close();
?>
