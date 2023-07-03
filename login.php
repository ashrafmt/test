<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];

        header("Location: logged.html");
        exit();
    }

    echo "Invalid email or password.";
}
?>
