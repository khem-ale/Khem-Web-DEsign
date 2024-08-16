<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT body FROM home";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PIXELS PORTFOLIO</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" /> -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
<style>
  .para p {
    position: absolute;
    left: 750px;
    top: 124px;
  }
</style>
</head>

<body>
  <header>
    <nav>
      <div class="left">Pixels Portfolio</div>
      <div class="right"></div>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="experience.php">Experience and Skills Page</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </header>
<div class="paragraph">
  <h2 class="paragraph-heading">Important Notice</h2>
  <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo"<p>" . htmlspecialchars($row["body"]) . "</p>";
                    }
                } else {
                    echo "";
                }
                ?>
</div>

<section>
  <div class="para">
    <p>
    Welcome to Pixels Team Photography, where moments are captured with creativity and passion.  At Pixels Team, we specialize in transforming fleeting instants into timeless memories. 
    Whether it's the joy of a wedding day, the intimacy of a portrait session, or the vibrancy of a corporate event, our team is dedicated to crafting stunning visual stories that resonate. 
    Explore our portfolio and discover how Pixels Team Photography can bring your moments to life, beautifully.
    </p>
  </div>
</section>
</body>

</html>