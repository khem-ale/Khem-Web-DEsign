<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pageContent = $_POST['page-content']; 
    
    $servername = "localhost";
    $username = "root";
    $password = "M106430369@m";
    $dbname = "technology";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "UPDATE home SET body = ? WHERE SN = 1"; 
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pageContent); 
    if ($stmt->execute()) {
        echo "Content updated successfully";
    } else {
        echo "Error updating content: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Pixels Photography</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
    font-family: 'Jost', sans-serif;
    background-color: #f8f8f8;
    color: #333;
}

.navbar {
    background-color: #111;
    color: #fff;
    padding: 1rem 6%;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo-wrapper a {
    font-size: 20px;
    color: #fff;
    text-decoration: none;
}

.navbar-links {
    list-style: none;
    display: flex;
    gap: 1rem;
}

.navbar-links a {
    color: #ccc;
    text-decoration: none;
}

.navbar-links a:hover,
.navbar-links .active {
    color: #fff;
}

.admin-container {
    padding: 2rem 6%;
}

.section {
    margin-bottom: 2rem;
}

h2 {
    color: #111;
    margin-bottom: 1rem;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

form label {
    font-size: 14px;
}

form input,
form textarea {
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form button {
    padding: 0.75rem 1rem;
    background-color: #111;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form button:hover {
    background-color: #333;
}

    </style>
<body>
<nav class="navbar">
        <div class="container">
            <div class="logo-wrapper">
                <a class="logo" href="index.html">Pixels Photography Admin</a>
            </div>
            <ul class="navbar-links">
            <li><a href="admin.php">Upload Photos</a></li>
            <li><a href="manage_images.php">Manage Images</a></li>
            <li><a href="manage_contacts.php">Manage Contacts</a></li>
            <li><a href="content.php">Manage Contents</a></li>
            </ul>
        </div>
    </nav>

    <section id="content" class="section">
            <h2>Content Management</h2>
            <form id="contentForm" action="#" method="post">
                <label for="page-content">Edit Page Content:</label>
                <textarea id="page-content" name="page-content" rows="10"></textarea>
                <button type="submit">Update</button>
            </form>
        </section>
</body>
</html>