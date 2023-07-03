<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = $_POST['search'];

    $stmt = $pdo->prepare("SELECT * FROM knowledge_base WHERE title LIKE ?");
    $searchQuery = '%' . $searchQuery . '%'; 
    $stmt->execute([$searchQuery]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "<h2>Search Results:</h2>";
        echo "<ul>";
        foreach ($result as $row) {
            echo "<li><a href='article.php?id={$row['id']}'>{$row['title']}</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No results found.";
    }
}
?>
