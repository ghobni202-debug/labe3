<?php
require_once "../config.php";
requireRole('professor');

$action = $_GET['action'] ?? $_POST['action'];

if ($action === 'students') {
    $semId = $_GET['semester_id'];
    $courseId = $_GET['course_id'];

    $students = Enrollment::getStudentsBySemester($semId);

    foreach ($students as &$s) {
        $s['grade'] = Grade::get($s['id'], $courseId, $semId);
    }

    echo json_encode($students);
}
