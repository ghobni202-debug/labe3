<?php
require_once "../config.php";
requireRole('professor');

$action = $_GET['action'] ?? $_POST['action'];

if ($action === 'save') {

    foreach ($_POST['grades'] as $g) {

        $stmt = $pdo->prepare("
            INSERT INTO grades(student_id,course_id,semester_id,grade)
            VALUES(?,?,?,?)
            ON DUPLICATE KEY UPDATE grade=?
        ");

        $stmt->execute([
            $g['student_id'],
            $_POST['course_id'],
            $_POST['semester_id'],
            $g['grade'],
            $g['grade']
        ]);
    }

    echo json_encode(["success" => true]);
}
