<?php include 'database/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notes App</title>
    <link rel="stylesheet" href="css/index.css">

</head>
<body>

<h1>All Notes</h1>

<a href="pages/createPage.php" class="add-btn">+ Add New Note</a>

<?php if (isset($_GET['success'])): ?>
    <p style="background:#d4edda; padding:10px; border-left:5px solid #28a745;">
        ✅ Note added successfully!
    </p>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM notes ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>
                <a href="pages/editPage.php?id=<?= $row['id'] ?>" class="action-btn edit-btn">Edit</a>
                <a href="api/delete.php?id=<?= $row['id'] ?>" class="action-btn delete-btn" onclick="return confirm('Delete this note?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
