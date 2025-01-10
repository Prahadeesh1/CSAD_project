<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="CSS/moviedetails.css">
</head>
<body>

<!-- Header Navigation -->
<div class="navbar">
    <img src="images/logo.png" alt="Logo" />
    <nav>
        <a href="main_page.html">Home</a>
        <a href="moviedetails.php">Movies</a>
        <a href="#">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
    </nav>
</div>

<h1>Movies</h1>
<div class="movies-container">
    <?php
    $movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);

    if ($movies['success']) {
        foreach ($movies['movies'] as $movie) {
            echo "<div class='movie-card'>";
            echo "<img src='" . $movie['cover'] . "' alt='" . $movie['title'] . "' class='movie-cover'>";
            echo "<h2>" . $movie['title'] . "</h2>";
            echo "<p><strong>Genre:</strong> " . $movie['genre'] . "</p>";
            echo "<p><strong>Cast:</strong> " . $movie['cast'] . "</p>";
            echo "<p><strong>Director:</strong> " . $movie['director'] . "</p>";
            echo "<p><strong>Synopsis:</strong> " . $movie['synopsis'] . "</p>";
            echo "<p><strong>Rating:</strong> " . $movie['rating'] . "</p>";
            echo "</div>";

        }
    } else {
        echo "<p>No movies available</p>";
    }
    ?>
</div>

</body>
</html>
