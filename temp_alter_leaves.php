<?php
include 'web07/api/db.php';
try {
    $pdo = new PDO('mysql:host=localhost;dbname=school_system;charset=utf8', 'root', '');
    $pdo->exec("ALTER TABLE `leaves` ADD `duration` INT(10) NOT NULL DEFAULT '0' AFTER `end_date` ");
    echo "Leave duration column added successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>