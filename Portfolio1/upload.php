<!-- yeha chai hamro upload admin pannel bata hune gareko -->
<?php
$servername = "localhost";
$username = "root";
$password = "M106430369@m";
$dbname = "technology";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
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
                $target_dir = 'pics/';
                $target_file = $target_dir . $newfilename;
                if (move_uploaded_file($fileTemp, $target_file)) {
                    $category = $_POST['category'];
                    $table = '';
                    
                    switch ($category) {
                        case 'wedding':
                            $table = 'wedding_images';
                            break;
                        case 'fashion':
                            $table = 'fashion_images';
                            break;
                        case 'marketing':
                            $table = 'marketing_images';
                            break;
                    }
                    
                    $query = "INSERT INTO $table (image) VALUES ('$newfilename')";
                    $res = mysqli_query($conn, $query);
                    if ($res) {
                        echo "File uploaded and saved to database successfully.";
                    } else {
                        echo "Failed to upload file to database.";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Error: File is too large.";
            }
        } else {
            echo "Error: File type not supported.";
        }
    } else {
        echo "No files uploaded.";
    }
}

$conn->close();
?>
