<?php
declare(strict_types=1);

require __DIR__ . '/database/db.php';
require __DIR__ . '/includes/helpers.php';

$sql = 'SELECT * FROM notes ORDER BY id DESC';
$result = $conn->query($sql);

$notes = [];
if ($result && $result->num_rows) {
    while ($row = $result->fetch_assoc()) {
        $row['summary'] = singleLineDescription($row['description'] ?? '');
        $notes[] = $row;
    }
}

$appRoot = appRoot();

include __DIR__ . '/pages/indexPage.php';
