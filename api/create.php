<?php include '../database/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Trim to remove extra spaces
    $title = trim($_POST['title']);
    $desc  = trim($_POST['description']);

    // Basic validation
    if ($title === "") {
        echo "<p style='color:red;'>Title is required.</p>";
    } else {
        // Prepare Insert
        $stmt = $conn->prepare("INSERT INTO notes (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $desc);

        if ($stmt->execute()) {
            // Redirect after saving
            header("Location: ../index.php?success=1");
            exit;
        } else {
            echo "<p style='color:red;'>Error saving note: {$stmt->error}</p>";
        }
    }
}
?>
