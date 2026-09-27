<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'db.php';

// Handle Record Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: dashboard.php?success=deleted");
            exit();
        }
    }
    header("Location: dashboard.php?error=1");
    exit();
}

// Handle Record Insertion & Updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action_type = $_POST['action_type'] ?? '';
    $firstname   = trim($_POST['firstname'] ?? '');
    $lastname    = trim($_POST['lastname'] ?? '');

    if (!empty($firstname) && !empty($lastname)) {
        if ($action_type === 'create') {
            $stmt = $conn->prepare("INSERT INTO students (firstname, lastname) VALUES (?, ?)");
            $stmt->bind_param("ss", $firstname, $lastname);
            if ($stmt->execute()) {
                header("Location: dashboard.php?success=created");
                exit();
            }
        } elseif ($action_type === 'update') {
            $id = intval($_POST['id'] ?? 0);
            if ($id > 0) {
                $stmt = $conn->prepare("UPDATE students SET firstname = ?, lastname = ? WHERE id = ?");
                $stmt->bind_param("ssi", $firstname, $lastname, $id);
                if ($stmt->execute()) {
                    header("Location: dashboard.php?success=updated");
                    exit();
                }
            }
        }
    }
}

header("Location: dashboard.php?error=1");
exit();
?>