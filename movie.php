    <?php
    include 'config.php';

    // Get the movie ID from the URL
    $id = $_GET['id'] ?? 0;
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    // Handle case where the movie is not found
    if (!$movie) {
        die("Movie not found!");
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style3.css">
    <title><?= htmlspecialchars($movie['title']) ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Row for two columns */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px; /* Adjust for padding */
        }

        /* Left Column (Smaller) */
        .column-left {
            flex: 40%; /* 30% width */
            padding: 10px;
        }

        /* Right Column (Larger) */
        .column-right {
            flex: 60%; /* 70% width */
            padding: 10px;
        }

        /* Movie Image Styling */
        .movie-image img {
            width: 80%;
            height: auto;
            border: 2px solid white;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
            
        }

        /* Rating Style */
        .rating {
            margin-top: 10px;
            background-color: rgba(0, 255, 255, 0.8);
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        /* Movie Description */
        .movie-description {
            margin-bottom: 20px;
            text-align: justify;
            font-size: 18px;
            line-height: 1.6;
        }

        /* Movie Trailer */
        .movie-trailer video {
            width: 100%;
            border: 2px solid white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
        }

        /* General Body Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background: radial-gradient(ellipse at bottom, #1b2634 0%, #292b39 100%);
            color: white;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

    <header>
        <h1 style="text-align: center;"><?= htmlspecialchars($movie['title']) ?></h1>
    </header>

    <div class="row">
        <!-- Left Column: Movie Image -->
        <div class="column-left movie-image">
            <img src="<?= htmlspecialchars($movie['image_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
            <span class="rating"><?= htmlspecialchars($movie['rating']) ?></span>
        </div>

        <!-- Right Column: Description and Trailer -->
        <div class="column-right">
            <div class="movie-description">
                <p><?= nl2br(htmlspecialchars($movie['description'])) ?></p>
            </div>
            <div class="movie-trailer">
                <video controls>
                    <source src="<?= htmlspecialchars($movie['trailer_path']) ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

    <footer style="text-align: center; margin-top: 20px;">
        <a href="main.php" style="color: aqua; text-decoration: none;">Return to Movies</a>
    </footer>

</body>
</html>