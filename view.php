<?php
declare(strict_types=1);

require __DIR__ . '/database/db.php';
require __DIR__ . '/includes/helpers.php';

$appRoot = appRoot();
$note = null;
$error = null;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $error = 'Invalid note identifier.';
} else {
    $stmt = $conn->prepare('SELECT * FROM notes WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $note = $result->fetch_assoc();

    if (!$note) {
        $error = 'The requested note was not found.';
    }
}

include __DIR__ . '/pages/viewPage.php';

