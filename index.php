<?php
declare(strict_types=1);

require __DIR__ . '/database/db.php';
require __DIR__ . '/includes/helpers.php';

// Pagination settings
$notesPerPage = 15;

// Get current page from query parameter (default to 1, minimum 1)
$currentPage = max(1, (int)($_GET['page'] ?? 1));

// Calculate offset
$offset = ($currentPage - 1) * $notesPerPage;

// Get total number of notes
$countResult = $conn->query('SELECT COUNT(*) as total FROM notes');
$totalNotes = 0;
if ($countResult && $row = $countResult->fetch_assoc()) {
    $totalNotes = (int)$row['total'];
}

// Calculate total pages
$totalPages = $totalNotes > 0 ? (int)ceil($totalNotes / $notesPerPage) : 1;

// Ensure current page doesn't exceed total pages
if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
    $offset = ($currentPage - 1) * $notesPerPage;
}

// Fetch notes with pagination using prepared statement
$notes = [];
$sql = 'SELECT * FROM notes ORDER BY id DESC LIMIT ? OFFSET ?';
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('ii', $notesPerPage, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row['summary'] = singleLineDescription($row['description'] ?? '');
            $notes[] = $row;
        }
    }
    $stmt->close();
}

$appRoot = appRoot();

include __DIR__ . '/pages/indexPage.php';
