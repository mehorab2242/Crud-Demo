<?php include '../database/db.php'; ?>

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM `notes` WHERE `id`='$id'");
$note = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    $stmt = $conn->prepare("UPDATE notes SET title=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $desc, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
