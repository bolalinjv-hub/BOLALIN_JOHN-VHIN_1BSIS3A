<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = intval($_POST['student_id']);
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);

    if ($id > 0 && !empty($firstname) && !empty($lastname)) {
        $stmt = $connection->prepare("UPDATE students SET firstname = ?, lastname = ? WHERE id = ?");
        $stmt->bind_param("ssi", $firstname, $lastname, $id);
        
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Student updated successfully!";
        } else {
            $_SESSION['msg_error'] = "Failed to update student.";
        }
    }
}

header("Location: home.php");
exit();
?>