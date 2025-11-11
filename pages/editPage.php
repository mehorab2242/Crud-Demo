<?php include '../api/edit.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Note</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>

<h1>Edit Note</h1>

<form method="POST">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>

    <label>Description:</label>
    <textarea name="description" rows="5"><?= htmlspecialchars($note['description']) ?></textarea>

    <button type="submit">Update</button>
</form>

<a href="../index.php" class="back-link">← Back to Notes</a>

</body>
</html>
