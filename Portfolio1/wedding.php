<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// wedding_images table bata image fetch gareko
$image_names = [];
$sql = "SELECT image FROM wedding_images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $image_names[] = $row['image'];
    }
} else {
    echo "No images found";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Photos - Wedding</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-color: rgb(25, 25, 28);
        color: white;
        font-family: "Poppins", sans-serif;
    }

    nav {
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 80px;
        background-color: rgb(73, 73, 77);
    }

    nav ul {
        display: flex;
        justify-content: center;
    }

    nav ul li {
        list-style: none;
        margin: 0 23px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
    }

    nav ul li a:hover {
        color: rgb(142, 142, 202);
        font-size: 1.25rem;
    }

    .first-section {
        background-image: url('./pics/photo7.png');
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 50vh;
    }

    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; 
        justify-content: center;
        margin: 20px;
    }

    .image-gallery div {
        width: 250px; 
        height: 250px; 
        overflow: hidden; 
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-gallery img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }

    .filter-menu {
        display: flex;
        justify-content: center;
        gap: 2rem;
        list-style: none;
        margin: 20px 0;
        padding: 0;
    }

    .filter-item:hover {
        cursor: pointer;
        color: rgb(142, 142, 202);
    }

    .active-filter {
        color: rgb(142, 142, 202);
        font-weight: bold;
    }
</style>

</head>
<body>

    <header>
        <nav>
            <div class="left">PIXELS GALLERY</div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="experience.php">Experience and Skills Page</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="first-section"></section>

    <div class="filter-menu">
        <li class="filter-item" data-filter="*">All</li>
        <li class="filter-item" data-filter="Fashion">Fashion</li>
        <li class="filter-item" data-filter="Wedding">Wedding</li>
        <li class="filter-item" data-filter="Marketing">Marketing</li>
    </div>

    <div class="image-gallery">
        <?php foreach ($image_names as $image_name): ?>
            <div>
                <img src="pics/<?php echo htmlspecialchars($image_name); ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function setActiveFilter() {
            const currentUrl = window.location.href;
            document.querySelectorAll('.filter-item').forEach(item => {
                const filter = item.getAttribute('data-filter');
                item.classList.remove('active-filter');
                if ((filter === '*' && currentUrl.includes('gallery.php')) ||
                    (filter === 'Fashion' && currentUrl.includes('fashion.php')) ||
                    (filter === 'Wedding' && currentUrl.includes('wedding.php')) ||
                    (filter === 'Marketing' && currentUrl.includes('marketing.php'))) {
                    item.classList.add('active-filter');
                }
            });
        }

        document.querySelectorAll('.filter-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.filter-item').forEach(el => el.classList.remove('active-filter'));
                this.classList.add('active-filter');
                const filter = this.getAttribute('data-filter');
                // click huda kata redirect hune garako
                setTimeout(() => {
                    if (filter === 'Wedding') {
                        window.location.href = 'wedding.php';
                    } else if (filter === '*') {
                        window.location.href = 'gallery.php';
                    } else if (filter === 'Fashion') {
                        window.location.href = 'fashion.php';
                    } else if (filter === 'Marketing') {
                        window.location.href = 'marketing.php';
                    } else {
                        window.location.href = '';
                    }
                }, 100);
            });
        });

        // kun chai active x vane ra active set gareko
        setActiveFilter();
    </script>
</body>
</html>
