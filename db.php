<?php
$host = 'localhost';
$db   = 'bsit3a'; // kun ano ginpangalan nyo sa database nyo!
$user = 'root'; // XAMPP default
$pass = '';     // XAMPP default is blank

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die("Database connection failed.");
}
?>