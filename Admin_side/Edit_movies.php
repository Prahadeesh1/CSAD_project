<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movies</title>
    <link rel="stylesheet" href="CSS/Edit_movie.css">
</head>
<body>
<!-- Header Navigation -->
<div class="navbar">
    <img src="static_image/logo.png" alt="Logo">
    <nav>
        <a href="#">Home</a>
        <a href="#">Movies</a>
        <a href="#">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
    </nav>
</div>

<!-- Headline -->
<h1>Edit Movies</h1>

<!-- Back Button -->
<button class="back-button" onclick="document.location='Page_admin.php'">Back to Admin</button>

<!-- Movies List -->
<div class="movie-container">
    <?php
    // Fetch movies from the API
    $apiUrl = "http://localhost/CSAD_project/Admin_side/movie_api.php";
    $response = json_decode(file_get_contents($apiUrl), true);

    // Check if the API response is successful
    if ($response && $response['success']) {
        foreach ($response['movies'] as $movie) {
            echo "<div class='movie-row'>";
            echo "    <div class='movie-details'>";
            echo "        <img src='" . htmlspecialchars($movie['cover']) . "' alt='" . htmlspecialchars($movie['title']) . " Poster' class='movie-poster'>";
            echo "        <div class='movie-info'>";
            echo "            <h2>" . htmlspecialchars($movie['title']) . "</h2>";
            echo "            <p><strong>Casts:</strong> " . htmlspecialchars($movie['cast']) . "</p>";
            echo "            <p><strong>Director:</strong> " . htmlspecialchars($movie['director']) . "</p>";
            echo "            <p><strong>Genre:</strong> " . htmlspecialchars($movie['genre']) . "</p>";
            echo "            <p><strong>Language:</strong> " . htmlspecialchars($movie['language']) . "</p>";
            echo "        </div>";
            echo "    </div>";
            echo "    <div class='movie-buttons'>";
            echo "        <button class='details-btn' onclick=\"location.href='Edit_details.php?id=" . urlencode($movie['id']) . "'\">Details</button>";
            echo "        <button class='time-btn' onclick=\"location.href='Edit_times.php?movie_id=" . urlencode($movie['id']) . "'\">Time</button>";
            echo "    </div>";
            echo "</div>";
        }
    } else {
        // If no movies are available or the API call fails
        echo "<p>No movies available.</p>";
    }
    ?>
</div>

</body>
</html>
