<!-- yo backend gareko -->
<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $conn->prepare("INSERT INTO contacts (firstname, middlename, lastname, email, phone, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $middlename, $lastname, $email, $phone, $message);
    if ($stmt->execute()) {
        echo "<p class='text-green-500'>Contact details submitted successfully.</p>";
    } else {
        echo "<p class='text-red-500'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-gradient {
            background-image: linear-gradient(to right, #6366F1 10%, #0EA5E9 50%, #10B981 90%);
        }

        .bg-image {
            background-image: url('./pics/photo7.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
        }
    </style>
</head>

<body class="bg-gray-100 relative overflow-auto">
    <header>
        <nav class="bg-gray-900 text-white p-4">
            <div class="text-2xl">Pixels Portfolio</div>
            <div class="max-w-6xl mx-auto flex justify-center items-center">
                <ul class="flex space-x-6">
                    <li><a href="index.php" class="hover:text-gray-400">Home</a></li>
                    <li><a href="gallery.php" class="hover:text-gray-400">Gallery</a></li>
                    <li><a href="experience.php" class="hover:text-gray-400">Experience and Skills</a></li>
                    <li><a href="contact.php" class="hover:text-gray-400">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="relative z-10">
        <div class="flex flex-col md:flex-row items-center md:items-start w-full max-w-4xl mx-auto p-8 border-4 border-solid border-gray-300 rounded-lg bg-white shadow-lg border-y-4 border-indigo-500 custom-gradient p-6">
            <div class="w-full md:w-1/2 p-4">
                <h1 class="text-2xl font-bold mb-6 text-left">Contact Us</h1>
                <form action="contact.php" method="POST" id="contactForm">
                    <div class="mb-4">
                        <label for="firstname" class="block text-gray-700 mb-1">First Name:</label>
                        <input type="text" id="firstname" name="firstname" required class="w-full p-2 border-2 border-indigo-500 rounded focus:outline-none focus:border-indigo-700 text-black">
                    </div>

                    <div class="mb-4">
                        <label for="middlename" class="block text-gray-700 mb-1">Middle Name:</label>
                        <input type="text" id="middlename" name="middlename" required class="w-full p-2 border-2 border-sky-500 rounded focus:outline-none focus:border-sky-700 text-black">
                    </div>

                    <div class="mb-4">
                        <label for="lastname" class="block text-gray-700 mb-1">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" required class="w-full p-2 border-2 border-emerald-500 rounded focus:outline-none focus:border-emerald-700 text-black">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-1">Email:</label>
                        <input type="email" id="email" name="email" required class="w-full p-2 border-2 border-pink-500 rounded focus:outline-none focus:border-pink-700 text-black">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 mb-1">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" class="w-full p-2 border-2 border-yellow-500 rounded focus:outline-none focus:border-yellow-700 text-black" required>
                        </div>
                    <script>
                        document.getElementById('contactForm').addEventListener('submit', function(event) {
                            var phoneInput = document.getElementById('phone');
                            var phonePattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; // Pattern for US numbers
                            if (!phonePattern.test(phoneInput.value)) {
                                alert('Invalid phone number');
                                event.preventDefault(); // Prevent form submission
                            }
                        });
                    </script>

                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 mb-1">Message:</label>
                        <textarea id="message" name="message" rows="4" required class="w-full p-2 border-2 border-red-500 rounded focus:outline-none focus:border-red-700 text-black"></textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded cursor-pointer hover:from-pink-500 hover:to-yellow-500">
                        Submit
                    </button>
                </form>
            </div>
            <div class="w-full md:w-1/2 h-56 p-2 pt-6 transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300">
                <img src="./pics/photo7.png" alt="Contact Us" class="w-full rounded-lg shadow-md">
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <h2 class="text-lg font-bold">Pixels Photography</h2>
                    <p>sirjana Street, Butwal, Nepal</p>
                    <p>Email: info@pixels.com</p>
                </div>
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6 text-center md:text-left">
                    <a href="#" class="text-gray-400 hover:text-white">About Us</a>
                    <a href="#" class="text-gray-400 hover:text-white">Contact</a>
                    <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
                </div>
            </div>
            <div class="text-center mt-6">
                <p>&copy; 2024 Pixels Photography. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div class="bg-image"></div>
</body>

</html>