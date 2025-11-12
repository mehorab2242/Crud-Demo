<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Note</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-transparent border-bottom border-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold text-dark" href="../index.php">
            <i class="bi bi-journal-text me-2"></i> Notes App
        </a>
        <div class="ms-auto">
            <a href="../index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Notes
            </a>
        </div>
    </div>
</nav>

<!-- Edit Form -->
<div class="container my-5" style="max-width: 700px;">
    <div class="card border-0 shadow-sm bg-transparent"
         style="--bs-card-bg: transparent; --bs-body-bg: transparent; --bs-border-color: rgba(255,255,255,0.3);">
        <div class="card-header bg-transparent py-3 border-0">
            <h5 class="mb-0 text-dark">
                <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Note
            </h5>
        </div>

        <div class="card-body">
            <?php
            include '../database/db.php';
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                $result = $conn->query("SELECT * FROM notes WHERE id = $id");
                $note = $result->fetch_assoc();
                if (!$note) {
                    echo '<div class="alert alert-danger bg-transparent border-danger text-danger">Note not found.</div>';
                }
            } else {
                echo '<div class="alert alert-danger bg-transparent border-danger text-danger">Invalid request.</div>';
            }
            ?>

            <?php if (!empty($note)) : ?>
                <form method="POST" action="../api/edit.php">
                    <input type="hidden" name="id" value="<?= (int)$note['id'] ?>">

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label text-dark">Title <span class="text-danger">*</span></label>
                        <input
                                type="text"
                                class="form-control bg-transparent border-secondary text-dark"
                                id="title"
                                name="title"
                                value="<?= htmlspecialchars($note['title']) ?>"
                                required
                                style="background-color: rgba(255,255,255,0.1);"
                        />
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label text-dark">Description</label>
                        <textarea
                                class="form-control bg-transparent border-secondary text-dark"
                                id="description"
                                name="description"
                                rows="5"
                                style="background-color: rgba(255,255,255,0.1);"
                        ><?= htmlspecialchars($note['description']) ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Update
                        </button>
                        <a href="../index.php" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
