<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);

    if (!empty($firstname) && !empty($lastname)) {
        $stmt = $connection->prepare("INSERT INTO students (firstname, lastname) VALUES (?, ?)");
        $stmt->bind_param("ss", $firstname, $lastname);
        
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Student added successfully!";
        } else {
            $_SESSION['msg_error'] = "Failed to add student.";
        }
    }
}

header("Location: home.php");
exit();
?>