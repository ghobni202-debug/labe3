<?php
require_once "models/User.php";

class AuthController {

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            global $pdo;

            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);

            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {

                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                header("Location: ?page=" . $user['role'] . ".dashboard");
                exit;
            }
        }

        require "views/login.php";
    }
}
