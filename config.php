
<?php
$pdo = new PDO("mysql:host=localhost;dbname=gpa_db", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function requireRole($role) {
    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("Location: ?page=login");
        exit;
    }
}
