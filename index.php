<?php include 'database/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Notes App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="./">
            <i class="bi bi-journal-text me-1"></i> Notes App
        </a>
        <div class="ms-auto">
            <a href="pages/createPage.php" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Note
            </a>
        </div>
    </div>
</nav>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th style="width:80px;">ID</th>
                        <th style="width:260px;">Title</th>
                        <th>Description</th>
                        <th style="width:180px;" class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM notes ORDER BY id DESC");
                    if ($result && $result->num_rows):
                        while ($row = mysqli_fetch_assoc($result)):
                            ?>
                            <tr>
                                <td class="fw-medium"><?= (int)$row['id'] ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="text-secondary">
                                    <?= nl2br(htmlspecialchars($row['description'])) ?>
                                </td>
                                <td class="text-end">
                                    <a href="pages/editPage.php?id=<?= (int)$row['id'] ?>" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <button
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="<?= (int)$row['id'] ?>"
                                    <i class="bi bi-trash"></i> Delete
                                </td>
                            </tr>
                        <?php
                        endwhile;
                    else:
                        ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                No notes yet. Click “Add New Note” to create one.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal (POST-based, safer than GET) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="../api/delete.php">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle text-danger me-2"></i> Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this note?
                <input type="hidden" name="id" id="deleteId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDeleteBtn" href="api/delete.php" class="btn btn-danger">Delete</a>
            </div>
        </form>
    </div>
</div>


<!-- Bootstrap Bundle (JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fill hidden input with the note id when opening modal
    const deleteModal = document.getElementById('deleteModal');
    deleteModal?.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        document.getElementById('deleteId').value = id;
    });
</script>
</body>
</html>
