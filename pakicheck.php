<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Queries the users table in phpcrudfraginal database
    $stmt = $connection->prepare("SELECT id, firstname, lastname, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname']  = $user['lastname'];

            header("Location: home.php");
            exit();
        }
    }

    header("Location: index.php?error=1");
    exit();
}
?>