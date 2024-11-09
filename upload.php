<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $penjelasan = $_POST['penjelasan'];
    $price = $_POST['price'];
    
    // File upload handling
    $targetDir = "img/"; // Directory where the uploaded images will be stored
    $fileName = basename($_FILES["foto"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow only certain file formats (you can customize this as needed)
    $allowedExtensions = array("jpg", "jpeg", "png");
    if (in_array($fileType, $allowedExtensions)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
            // Upload data to the database
            $sql = "INSERT INTO product (name, penjelasan, price, foto) VALUES ('$name', '$penjelasan', $price, '$fileName')";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                // Data uploaded successfully
                // You can redirect to a success page or display a success message
                header("Location: upload.php");
                exit();
            } else {
                // Error occurred during data upload
                // You can redirect to an error page or display an error message
                header("Location: error.php");
                exit();
            }
        } else {
            // Error occurred while moving the uploaded file
            // You can redirect to an error page or display an error message
            header("Location: error.php");
            exit();
        }
    } else {
        // Invalid file format
        // You can redirect to an error page or display an error message
        header("Location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Form</title>
</head>

<body>
    <h1>Upload Form</h1>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="penjelasan">Penjelasan:</label>
        <input type="text" name="penjelasan" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" required>
        <br>
        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*" required>
        <br>
        <button type="submit">Upload</button>
    </form>
</body>

</html>