<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$image_names = [];

// Wedding ko Images
$sql = "SELECT image FROM wedding_images";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $image_names[] = $row['image'];
  }
}

// Fashion ko Images
$sql = "SELECT image FROM fashion_images";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $image_names[] = $row['image'];
  }
}

// Marketing ko Images
$sql = "SELECT image FROM marketing_images";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $image_names[] = $row['image'];
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GALLERY</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <style>
    .filter-item:hover {
      cursor: pointer;
      color: rgb(142, 142, 202);
    }

    .first-section {
      background-image: url('./pics/photo7.png');
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      height: 50vh;
    }

    .active-filter {
      color: rgb(142, 142, 202);
      font-weight: bold;
    }

    .image-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
    }

    .image-container {
      width: calc(25% - 16px); 
      margin: 8px; 
    }

    .image-container img {
      width: 100%;
      height: 200px; 
      object-fit: cover; 
      object-position: center; 
      border-radius: 8px; 
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    }
  </style>
</head>
<body class="bg-gray-900 text-white font-sans">
  <header>
    <nav class="flex justify-between items-center h-20 bg-gray-700 px-6">
      <div class="text-2xl">PIXELS GALLERY</div>
      <ul class="flex space-x-8">
        <li><a href="index.php" class="hover:text-blue-400 text-lg">Home</a></li>
        <li><a href="gallery.php" class="hover:text-blue-400 text-lg">Gallery</a></li>
        <li><a href="experience.php" class="hover:text-blue-400 text-lg">Experience and Skills Page</a></li>
        <li><a href="contact.php" class="hover:text-blue-400 text-lg">Contact</a></li>
      </ul>
    </nav>
  </header>

  <section class="first-section"></section>

  <div class="flex justify-center mt-8">
    <ul class="flex space-x-6 text-lg">
      <li class="filter-item active-filter" data-filter="*">All</li>
      <li class="filter-item" data-filter="Fashion">Fashion</li>
      <li class="filter-item" data-filter="Wedding">Wedding</li>
      <li class="filter-item" data-filter="Marketing">Marketing</li>
    </ul>
  </div>

  <div class="image-gallery mt-8 mx-4">
    <?php if (!empty($image_names)) : ?>
      <?php foreach ($image_names as $image_name) : ?>
        <div class="image-container">
          <img src="pics/<?php echo htmlspecialchars($image_name); ?>" alt="<?php echo htmlspecialchars($image_name); ?>" class="w-full h-auto object-cover rounded-lg shadow-md">
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No images in the gallery.</p>
    <?php endif; ?>
  </div>

  <script>
    document.querySelectorAll('.filter-item').forEach(item => {
      item.addEventListener('click', function() {
        document.querySelectorAll('.filter-item').forEach(el => el.classList.remove('active-filter'));
        this.classList.add('active-filter');
        const filter = this.getAttribute('data-filter');
        if (filter === 'Wedding') {
          window.location.href = 'wedding.php';
        } else if (filter === '*') {
          window.location.href = 'gallery.php';
        } else if (filter === 'Fashion') {
          window.location.href = 'fashion.php';
        } else if (filter === 'Marketing') {
          window.location.href = 'marketing.php';
        }
      });
    });
  </script>
</body>
</html>
