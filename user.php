<?php
class User {

    public static function create($name, $email, $password, $role) {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT), $role]);
    }
}
