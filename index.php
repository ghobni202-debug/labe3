<?php
session_start();
require_once "config.php";

$page = $_GET['page'] ?? 'login';

switch (true) {

    case $page === 'login':
        require "controllers/AuthController.php";
        (new AuthController())->login();
        break;

    case str_starts_with($page, 'admin.'):
        requireRole('admin');
        require "controllers/AdminController.php";
        (new AdminController())->handle($page);
        break;

    case str_starts_with($page, 'professor.'):
        requireRole('professor');
        require "controllers/ProfessorController.php";
        (new ProfessorController())->handle($page);
        break;

    case str_starts_with($page, 'student.'):
        requireRole('student');
        require "controllers/StudentController.php";
        (new StudentController())->handle($page);
        break;

    default:
        header("Location: ?page=login");
}
