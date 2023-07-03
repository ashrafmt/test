<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $photo = $_FILES['img'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio'];

    $uploadDir = 'uploads/';
    $uploadedFileName = $photo['name'];
    $uploadedFileTmp = $photo['tmp_name'];
    $uploadedFileSize = $photo['size'];

    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $fileExtension;
    $destination = $uploadDir . $newFileName;

    if (move_uploaded_file($uploadedFileTmp, $destination)) {
        require_once '../db.php';
        $stmt = $pdo->prepare("INSERT INTO user_profiles (username, photo, gender, bio) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $newFileName, $gender, $bio]);

        if ($stmt->rowCount() > 0) {
            
            echo "Profile saved.";
            exit();
        } else {
           
            echo "Error saving profile.";
        }
    } else {
        // File upload error
        echo "Error uploading the file.";
    }
}
?>
