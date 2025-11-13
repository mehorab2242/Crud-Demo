<?php
include '../database/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$title = trim($_POST['title'] ?? '');
$desc = trim($_POST['description'] ?? '');

if (!$id) {
    die('Invalid note identifier.');
}

if ($title === '') {
    die('Title is required.');
}

$stmt = $conn->prepare('UPDATE notes SET title = ?, description = ? WHERE id = ?');
$stmt->bind_param('ssi', $title, $desc, $id);

if ($stmt->execute()) {
    header('Location: ../index.php?updated=1');
    exit;
}

echo 'Error updating note: ' . $stmt->error;
