<?php
//session start gareko
session_start();

$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ''; // error message store garna variable garako

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validate gareko kunai inputfield khali x ki xaina vanera check gareko
    if (empty($username) && empty($password)) {
        $error = 'Both fields are required.';
    } elseif (empty($username)) {
        $error = 'Username is required.';
    } elseif (empty($password)) {
        $error = 'Password is required.';
    } else {
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Login successful vayoo vane , session start hunx
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: admin.php"); // login vai sake paxi admin panel ma redirect hunx
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-80">
        <h2 class="text-2xl mb-4">Admin Login</h2>
        <form action="login.php" method="POST">
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 mb-2">Username:</label>
                <input type="text" id="username" name="username" class="w-full p-2 border rounded" value="<?php echo htmlspecialchars($username ?? ''); ?>">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2">Password:</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
