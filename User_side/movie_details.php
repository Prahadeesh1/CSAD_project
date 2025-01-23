<?php
$movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);

if (isset($_GET['id'])) {
    $movieId = $_GET['id'];
    $apiUrl = "http://localhost/CSAD_project/Admin_side/movie_api.php";
    
    // Fetch the movies data from the API
    $moviesData = json_decode(file_get_contents($apiUrl), true);

    if ($moviesData['success']) {
        // Search for the selected movie in the API response
        $selectedMovie = null;
        foreach ($moviesData['movies'] as $movie) {
            if ($movie['id'] == $movieId) {
                $selectedMovie = $movie;
                break;
            }
        }

        if (!$selectedMovie) {
            echo "<p>Movie not found.</p>";
            exit;
        }
    } else {
        echo "<p>Failed to fetch movie data.</p>";
        exit;
    }
} else {
    echo "<p>No movie ID provided.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($selectedMovie['title']); ?> - Movie Details</title>
    <link rel="stylesheet" href="CSS/moviedetails.css" />
</head>
<body>
    <!-- Header Navigation -->
    <div class="navbar">
        <img src="images/logo.png" alt="Logo" />
        <a href="moviesection.php">Movies</a>
        <a href="#">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
    </div>

    <!-- Movie Details Section -->
    <main class="movie-details">''
        <div class="details-container">
            <div class="poster-container">
                <img src="<?php echo htmlspecialchars($selectedMovie['cover']); ?>" alt="Movie Poster" />
            </div>
            <div class="info-container">
                <h1 class="movie-title"><?php echo htmlspecialchars($selectedMovie['title']); ?></h1>
                <h2>Movie Details</h2>
                <p><strong>Cast: </strong><?php echo htmlspecialchars($selectedMovie['cast']); ?></p>
                <p><strong>Director: </strong><?php echo htmlspecialchars($selectedMovie['director']); ?></p>
                <p><strong>Synopsis: </strong><?php echo htmlspecialchars($selectedMovie['synopsis']); ?></p>
                <div class="extra-details">
                    <div><strong>Genre:</strong> <?php echo htmlspecialchars($selectedMovie['genre']); ?></div>
                    <div><strong>Language:</strong> <?php echo htmlspecialchars($selectedMovie['language']); ?></div>
                    <div><strong>Rating:</strong> <?php echo htmlspecialchars($selectedMovie['rating']); ?></div>
                    <div><strong>Runtime:</strong> <?php echo htmlspecialchars($selectedMovie['runtime']); ?> mins</div>
                    <div><strong>Subtitle:</strong> <?php echo htmlspecialchars($selectedMovie['subtitle']); ?></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Dates Section -->
    <h3 class="date-title">Select Date</h3>
    <div class="div-date">
        <button class="date-button date-option" type="button">
            <p class="date">FRI</p>
            <h2>10</h2>
            <p class="date">JAN</p>
        </button>
        <button class="date-button date-option" type="button">
            <p class="date">SAT</p>
            <h2>11</h2>
            <p class="date">JAN</p>
        </button>
        <button class="date-button date-option" type="button">
            <p class="date">SUN</p>
            <h2>12</h2>
            <p class="date">JAN</p>
        </button>
        <button class="date-button date-option" type="button">
            <p class="date">MON</p>
            <h2>13</h2>
            <p class="date">JAN</p>
        </button>
    </div>

    <!-- Location & Time Section -->
    <div class="section-container">
        <h3 class="time-title">Select Cinema & Time</h3>
        <div class="location-sample">
            <h3 class="location-title">Sample Cinema</h3>
            <div class="div-time">
                <button class="time-button time-option">
                    <p>11:00AM</p>
                </button>
                <button class="time-button time-option">
                    <p>2:00PM</p>
                </button>
                <button class="time-button time-option">
                    <p>6:30PM</p>
                </button>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-links">
            <div class="footer-column">
                <h3>HOME</h3>
                <ul>
                    <li><a href="#">Log In/Register</a></li>
                    <li>
                        <a href="#" onclick="document.location='Admin_side/Login_admin.html'">Admin Page</a>
                    </li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>LEGAL</h3>
                <ul>
                    <li><a href="termsandconditions.html">Terms & Conditions</a></li>
                    <li><a href="privacypolicy.html">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>CUSTOMER SERVICES</h3>
                <ul>
                    <li><a href="contactus.html">Contact Us</a></li>
                    <li><a href="faqs.html">FAQs</a></li>
                </ul>
            </div>
        </div>
        <p>&copy; 2024 PrismVerse Cinematics Pte Ltd. All rights reserved.</p>
    </footer>
</body>
</html>
