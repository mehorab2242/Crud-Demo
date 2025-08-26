<?php include 'db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO notes (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $desc);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Note</title>
</head>
<body>
<h1>Add New Note</h1>
<form method="POST">
    <label>Title:</label><br>
    <label>
        <input type="text" name="title" required>
    </label><br><br>

    <label>Description:</label><br>
    <label>
        <textarea name="description" rows="5"></textarea>
    </label><br><br>

    <button type="submit">Save</button>
</form>
<br>
<a href="index.php">Back</a>
</body>
</html>
