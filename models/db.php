<?php
require "credentials.php";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database",$dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Ulandi";
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}
?>
