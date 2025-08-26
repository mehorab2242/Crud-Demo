<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM notes WHERE id=$id");
$note = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    $stmt = $conn->prepare("UPDATE notes SET title=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $desc, $id);

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
    <title>Edit Note</title>
</head>
<body>
<h1>Edit Note</h1>
<form method="POST">
    <label>Title:</label><br>
    <label>
        <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>
    </label><br><br>

    <label>Description:</label><br>
    <label>
        <textarea name="description" rows="5"><?= htmlspecialchars($note['description']) ?></textarea>
    </label><br><br>

    <button type="submit">Update</button>
</form>
<br>
<a href="index.php">Back</a>
</body>
</html>
