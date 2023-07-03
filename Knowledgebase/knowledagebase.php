<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO knowledge_base (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    if ($stmt->rowCount() > 0) {
        echo "added Successed";
        exit();
    } else {
        echo "Error inserting data into the database.";
    }
}
?>
