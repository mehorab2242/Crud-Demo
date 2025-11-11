<?php include '../database/db.php'; ?>

<?php
$id = $_GET['id'];
$conn->query("DELETE FROM notes WHERE id=$id");

header("Location: ../index.php");
exit;
