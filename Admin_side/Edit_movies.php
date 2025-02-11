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
    <a href="../User_side/main_page.php">Home</a>
        <a href="../User_side/moviesection.php">Movies</a>
        <a href="../User_side/cinemas.html">Cinemas</a>
        <a href="../User_side/experiences.html">Experiences</a>
        <a href="../User_side/events_booking.php">Events Booking</a>
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
