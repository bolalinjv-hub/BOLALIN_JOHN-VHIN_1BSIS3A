<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id > 0) {
        $stmt = $connection->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Student record deleted successfully!";
        } else {
            $_SESSION['msg_error'] = "Failed to delete student.";
        }
    }
}

header("Location: home.php");
exit();
?>