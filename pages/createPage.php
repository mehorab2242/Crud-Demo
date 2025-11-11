<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Note</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>

<h1>Add New Note</h1>

<form method="POST" action="../api/create.php">
    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Description:</label>
    <textarea name="description" rows="5"></textarea>

    <button type="submit">Save</button>
</form>

<a href="../index.php" class="btn btn-primary btn-lg" style="padding-top: 20px">← Back to Notes</a>

</body>
</html>
