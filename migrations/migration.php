<?php

include __DIR__ . '/../db.php';


$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) DEFAULT NULL,
    text TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$stmt->execute();

// Added updated_at column

$stmt = $db->prepare("ALTER TABLE posts ADD updated_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP");
$stmt->execute();

echo "Table created successfully\n";
?>
