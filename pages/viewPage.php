<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>View Note</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= htmlspecialchars($appRoot) ?>css/create.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-transparent border-bottom border-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold text-dark" href="<?= htmlspecialchars($appRoot) ?>">
            <i class="bi bi-journal-text me-2"></i> Notes App
        </a>
        <div class="ms-auto">
            <a href="<?= htmlspecialchars($appRoot) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Notes
            </a>
        </div>
    </div>
</nav>

<div class="container my-5" style="max-width: 720px;">
    <div class="card border-0 shadow-sm bg-transparent"
         style="--bs-card-bg: transparent; --bs-body-bg: transparent; --bs-border-color: rgba(255,255,255,0.3);">
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger bg-transparent border-danger text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                </div>
                <a href="<?= htmlspecialchars($appRoot) ?>" class="btn btn-light">
                    <i class="bi bi-arrow-left-circle me-1"></i> Back to Notes
                </a>
            <?php else: ?>
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-4 gap-3">
                    <div>
                        <h1 class="h4 text-dark mb-1">
                            <?= htmlspecialchars($note['title']) ?>
                        </h1>
                        <p class="text-muted mb-0">
                            <i class="bi bi-hash me-1"></i>Note ID: <?= (int)$note['id'] ?>
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= htmlspecialchars($appRoot) ?>edit.php?id=<?= (int)$note['id'] ?>" class="btn btn-primary d-inline-flex align-items-center">
                            <img src="<?= htmlspecialchars($appRoot) ?>public/icons/edit.svg" alt="" width="16" height="16" class="me-1">
                            Edit
                        </a>
                        <button
                            type="button"
                            class="btn btn-danger d-inline-flex align-items-center"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="<?= (int)$note['id'] ?>"
                        >
                            <img src="<?= htmlspecialchars($appRoot) ?>public/icons/trash.svg" alt="" width="16" height="16" class="me-1">
                            Delete
                        </button>
                    </div>
                </div>

                <div class="bg-white bg-opacity-75 border rounded-3 p-4 mb-4">
                    <?php if (trim($note['description']) !== ''): ?>
                        <p class="mb-0 text-dark"><?= nl2br(htmlspecialchars(trim($note['description']))) ?></p>
                    <?php else: ?>
                        <p class="mb-0 text-muted fst-italic">No description provided for this note.</p>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= htmlspecialchars($appRoot) ?>" class="btn btn-light">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back to Notes
                    </a>
                    <a href="<?= htmlspecialchars($appRoot) ?>create.php" class="btn btn-outline-secondary">
                        <i class="bi bi-plus-lg me-1"></i> Add New Note
                    </a>
                </div>
            <?php endif; ?>
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
    const deleteModal = document.getElementById('deleteModal');
    deleteModal?.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        document.getElementById('deleteId').value = button.getAttribute('data-id');
    });
</script>
</body>
</html>

