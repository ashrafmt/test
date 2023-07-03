<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
        
        $file = $_FILES['media'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        
        $uploadDir = 'uploads/';

        
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $fileExtension;
        $destination = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destination)) {
            
            echo "File uploaded successfully.";
        } else {
            
            echo "Error on uploading  file.";
        }
    }
}
?>
