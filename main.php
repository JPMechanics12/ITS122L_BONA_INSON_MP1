<?php
include 'config.php';

// Pagination setup
$search = $_GET['search'] ?? ''; // Get the search query if present
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$moviesPerPage = 5; // Maximum movies per page
$offset = ($page - 1) * $moviesPerPage;

// Rating Filter
$ratingFilter = $_GET['rating_filter'] ?? []; // Get the rating filter as an array

// Prepare total query with optional rating filter
$totalQuery = "SELECT COUNT(*) FROM movies WHERE title LIKE :search";
if (!empty($ratingFilter)) {
    $ratingPlaceholders = [];
    foreach ($ratingFilter as $index => $rating) {
        $ratingPlaceholders[] = ":rating$index";
    }
    $totalQuery .= " AND rating IN (" . implode(',', $ratingPlaceholders) . ")";
}

$totalStmt = $conn->prepare($totalQuery);
$totalStmt->bindValue(':search', "%$search%");
if (!empty($ratingFilter)) {
    foreach ($ratingFilter as $index => $rating) {
        $totalStmt->bindValue(":rating$index", $rating);
    }
}
$totalStmt->execute();
$totalMovies = $totalStmt->fetchColumn();

// Prepare movies query with optional rating filter
$query = "SELECT * FROM movies WHERE title LIKE :search";
if (!empty($ratingFilter)) {
    $ratingPlaceholders = [];
    foreach ($ratingFilter as $index => $rating) {
        $ratingPlaceholders[] = ":rating$index";
    }
    $query .= " AND rating IN (" . implode(',', $ratingPlaceholders) . ")";
}
$query .= " LIMIT :offset, :limit"; // Always add pagination limits

$stmt = $conn->prepare($query);
$stmt->bindValue(':search', "%$search%");
if (!empty($ratingFilter)) {
    foreach ($ratingFilter as $index => $rating) {
        $stmt->bindValue(":rating$index", $rating);
    }
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $moviesPerPage, PDO::PARAM_INT);
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total pages
$totalPages = ceil($totalMovies / $moviesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <title>Movies</title>
    <style>
        .rating-options {
            display: none; /* Default to hidden, shown when toggled */
            text-align: left;
            margin-top: 10px;
        }

        .rating-options label {
            display: block;
            margin: 5px 0;
        }

        .rating-header {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.1em;
            color: black
        }
    </style>
    <script>
        function toggleRatingOptions() {
            const optionsSection = document.getElementById('rating-options');
            optionsSection.style.display = optionsSection.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Movies</h1>
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search movies..." value="<?= htmlspecialchars($search) ?>">
                <button type="button" class="show-options" onclick="toggleRatingOptions()">Filter by Rating</button>

                <!-- Rating Options Section -->
                <div id="rating-options" class="rating-options">
                    <div class="rating-header">Include Ratings:</div>
                    <?php
                    $ratings = ['G', 'PG', 'PG-13', 'R', 'NR'];
                    foreach ($ratings as $rating) : ?>
                        <label>
                            <input type="checkbox" name="rating_filter[]" value="<?= htmlspecialchars($rating) ?>" <?= in_array($rating, $ratingFilter) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($rating) ?>
                        </label>
                    <?php endforeach; ?>
                    <button type="submit" class="show-options">Apply Filters</button>
                </div>
            </form>
        </div>
    </header>

    <!-- Movie Images -->
    <section class="movie-images">
        <div class="stars-middle">
            <?php for ($i = 1; $i <= 15; $i++): ?>
                <div class="star" style="top: <?= rand(10, 90) ?>%; left: <?= rand(5, 95) ?>%; animation-duration: <?= rand(3, 6) ?>s;"></div>
            <?php endfor; ?>
        </div>
        <div class="image-container">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-item" style="position: relative;">
                    <a href="movie.php?id=<?= htmlspecialchars($movie['id']) ?>">
                        <img src="<?= htmlspecialchars($movie['image_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                        <p><?= htmlspecialchars($movie['title']) ?></p>
                        <span class="rating"><?= htmlspecialchars($movie['rating']) ?></span> <!-- Display rating -->
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&<?= http_build_query(['rating_filter' => $ratingFilter]) ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>
    </div>

    <!-- Footer -->
    <footer>
        <a href="logout.php">Logout</a>
    </footer>
</body>
</html>
