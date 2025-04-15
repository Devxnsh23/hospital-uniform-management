<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Hospital Uniforms</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">All Uniforms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_uniform.php">Add New</a>
                    </li>
                </ul>
                <form action="search.php" method="get" class="d-flex ms-auto">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search uniforms..." value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
                    <button class="btn btn-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Search Results</h1>
        
        <a href="index.php" class="btn btn-secondary mb-4">← Back to All Uniforms</a>

        <?php if (!empty($_GET['query'])): ?>
            <div class="alert alert-info mb-4">
                Showing results for: <strong><?= htmlspecialchars($_GET['query']) ?></strong>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_GET['query'])) {
                        $query = '%' . $_GET['query'] . '%';
                        $stmt = $pdo->prepare("SELECT * FROM uniforms WHERE name LIKE ? ORDER BY created_at DESC");
                        $stmt->execute([$query]);
                        
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td><span class='badge bg-secondary'>{$row['size']}</span></td>
                                        <td><span class='color-badge' style='background-color:{$row['color']}'></span> {$row['color']}</td>
                                        <td>₹{$row['price']}</td>
                                        <td>{$row['created_at']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4'>No results found for your search.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-4'>Please enter a search term.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>