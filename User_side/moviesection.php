<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="CSS/mainpage.css">
    <style>
        /* Custom styles for movie grid layout */
        .movies-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .movie-card {
            background: #222;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #fff;
        }
        .movie-card img {
            width: 100%;
            height: auto; /* Automatically maintain aspect ratio */
            aspect-ratio: 2/3; /* Set aspect ratio for consistent sizing */
            object-fit: cover; /* Ensures image fills the area */
        }

        .movie-card h2 {
            font-size: 1.5rem;
            margin: 10px 0;
            color: #f39c12;
        }
        .movie-card p {
            margin: 10px 0;
            font-size: 1rem;
            color: #ccc;
        }
        .buy-ticket {
            display: inline-block;
            margin: 15px 0;
            padding: 10px 20px;
            background-color: #8b0000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .buy-ticket:hover {
            background-color: #f39c12;
        }
    </style>
</head>
<body>

<!-- Header Navigation -->
<div class="navbar">
    <img src="images/logo.png" alt="Logo" />
    <nav>
    <a href="main_page.php">Home</a>
        <a href="moviesection.php">Movies</a>
        <a href="cinemas.html">Cinemas</a>
        <a href="experiences.html">Experiences</a>
        <a href="events_booking.php">Events Booking</a>
      </nav>
    </nav>
</div>

<main>
      <section class="now-showing">
        <h1>Now Showing</h1>
        <div class="movie-grid">
          <?php
          // Fetch movies from the API
          $movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);

          if ($movies['success']) {
              foreach ($movies['movies'] as $movie) {
                  echo "<div class='movie-post'>";
                  echo "<img src='" . htmlspecialchars($movie['cover']) . "' alt='" . htmlspecialchars($movie['title']) . " Poster' />";
                  echo "<div class='movie-info'>";
                  echo "<h2>" . htmlspecialchars($movie['title']) . "</h2>";
                  echo "<p>Rating: " . htmlspecialchars($movie['rating']) . "</p>";
                  echo "<p>Runtime:" . htmlspecialchars($movie['runtime']) . " mins</p>";
                  echo "<p>Genre: " . htmlspecialchars($movie['genre']) . "</p>";
                  echo "<a href='movie_details.php?id=" . urlencode($movie['id']) . "' class='button'>Book Now</a>";
                  echo "</div>";
                  echo "</div>";
              }
          } else {
              echo "<p>No movies available</p>";
          }
          ?>
        </div>
      </section>
    </main>
<footer>
    <p>© 2025 Movie World. All Rights Reserved.</p>
</footer>

</body>
</html>