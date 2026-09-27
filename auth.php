<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, firstname, lastname, password FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($user = $res->fetch_assoc()) {
            if ($password === $user['password'] || password_verify($password, $user['password'])) {
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname']  = $user['lastname'];
                header("Location: dashboard.php");
                exit();
            }
        }
    }
}

header("Location: index.php?failed=1");
exit();
?>