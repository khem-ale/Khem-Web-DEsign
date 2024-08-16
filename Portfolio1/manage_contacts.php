<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Manage Contacts</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <header>
        <h1>Admin Panel</h1>
    </header>

    <nav>
        <ul>
            <li><a href="admin.php">Upload Photos</a></li>
            <li><a href="manage_images.php">Manage Images</a></li>
            <li><a href="manage_contacts.php">Manage Contacts</a></li>
            <li><a href="content.php">Manage Contents</a></li>
        </ul>
    </nav>

    <main>
       
    </main>
</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $contact_id = $_GET['delete'];
    $query = "DELETE FROM contacts WHERE id = $contact_id";
    if (mysqli_query($conn, $query)) {
        echo "<p class='text-green-500'>Contact deleted successfully.</p>";
    } else {
        echo "<p class='text-red-500'>Failed to delete contact.</p>";
    }
}

echo "<h2 class='text-2xl mb-4'>Contact Details</h2>";
$query = "SELECT id, firstname, middlename, lastname, email, phone, message FROM contacts";
$result = mysqli_query($conn, $query);

echo "<table class='w-full bg-white rounded shadow-md mb-4'>";
echo "<tr><th>ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Action</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['middlename'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['message'] . "</td>";
    echo "<td><a href='manage_contacts.php?delete=" . $row['id'] . "' class='text-red-500 hover:text-red-700'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
?>
