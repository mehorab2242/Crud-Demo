<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Notes App</title>
</head>
<body>
<h1>All Notes</h1>
<a href="create.php">+ Add New Note</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM notes ORDER BY id DESC");
    while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this note?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
