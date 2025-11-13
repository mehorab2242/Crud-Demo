<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Notes App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= htmlspecialchars($appRoot) ?>css/index.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-transparent border-bottom">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?= htmlspecialchars($appRoot) ?>">
            <i class="bi bi-journal-text me-1"></i> Notes App
        </a>
        <div class="ms-auto">
            <a href="<?= htmlspecialchars($appRoot) ?>create.php" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Note
            </a>
        </div>
    </div>
</nav>

<div class="container bg-transparent my-4">
    <div class="card bg-transparent shadow-sm">
        <div class="card-body p-0">
            <div class="table-rapper">
                <div class="table-responsive">
                    <table
                        class="table table-hover align-middle mb-0"
                        style="
                        --bs-table-bg: transparent;
                        --bs-table-striped-bg: transparent;
                        --bs-table-hover-bg: rgba(255,255,255,0.50);
                        --bs-table-border-color: rgba(255,255,255,1.35);
                    "
                    >
                        <thead>
                        <tr>
                            <th style="width:260px;">Title</th>
                            <th>Description</th>
                            <th style="width:220px;" class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($notes ?? [])): ?>
                            <?php foreach ($notes as $row): ?>
                                <tr>
                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($row['title']) ?>
                                    </td>
                                    <td class="text-dark">
                                        <?php if (trim($row['summary'] ?? '') !== ''): ?>
                                            <?= htmlspecialchars($row['summary']) ?>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">No description</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= htmlspecialchars($appRoot) ?>view.php?id=<?= (int)$row['id'] ?>"
                                           class="btn btn-sm btn-outline-secondary me-2 d-inline-flex align-items-center">
                                            <img src="<?= htmlspecialchars($appRoot) ?>public/icons/view.svg" alt="" width="16" height="16" class="me-1">
                                        </a>
                                        <a href="<?= htmlspecialchars($appRoot) ?>edit.php?id=<?= (int)$row['id'] ?>"
                                           class="btn btn-sm btn-outline-primary me-2 d-inline-flex align-items-center">
                                            <img src="<?= htmlspecialchars($appRoot) ?>public/icons/edit.svg" alt="" width="16" height="16" class="me-1">
                                        </a>
                                        <button
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="<?= (int)$row['id'] ?>">
                                            <img src="<?= htmlspecialchars($appRoot) ?>public/icons/trash.svg" alt="" width="16" height="16" class="me-1">
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No notes yet. Click the button below to create one.
                                    <div class="mt-3">
                                        <a href="<?= htmlspecialchars($appRoot) ?>create.php" class="btn btn-secondary">
                                            <i class="bi bi-plus-lg me-1"></i> Add New Note
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="<?= htmlspecialchars($appRoot) ?>api/delete.php">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                    Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this note?
                <input type="hidden" name="id" id="deleteId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fill hidden input with the note id when opening modal
    const deleteModal = document.getElementById('deleteModal');
    deleteModal?.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        document.getElementById('deleteId').value = button.getAttribute('data-id');
    });
</script>
</body>
</html>
