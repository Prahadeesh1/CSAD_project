<?php
// Fetch movies from the API
$movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Movies</title>
    <link rel="stylesheet" href="CSS/Delete_movie.css">
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
    <h1>Delete Movies</h1>

    <!-- Back Button -->
    <button class="back-button" onclick="document.location='Page_admin.php'">Back to Admin</button>

    <!-- Movies List -->
    <?php
    if ($movies['success']) {
        foreach ($movies['movies'] as $movie) {
            echo "<div class='movie-container'>";
            echo "<div class='movie-row'>";
            echo "<input type='checkbox' class='movie-select' data-id='" . htmlspecialchars($movie['id']) . "'>";
            echo "<div class='movie-details'>";
            echo "<img src='" . htmlspecialchars($movie['cover']) . "' alt='Movie Poster' class='movie-poster'>";
            echo "<div class='movie-info'>";
            echo "<h2>" . htmlspecialchars($movie['title']) . "</h2>";
            echo "<p><strong>Casts:</strong> " . htmlspecialchars($movie['cast']) . "</p>";
            echo "<p><strong>Director:</strong> " . htmlspecialchars($movie['director']) . "</p>";
            echo "<p><strong>Genre:</strong> " . htmlspecialchars($movie['genre']) . "</p>";
            echo "<p><strong>Language:</strong> " . htmlspecialchars($movie['language']) . "</p>";
            echo "</div></div></div></div>";
        }
    } else {
        echo "<p>No movies available</p>";
    }
    ?>

    <!-- Delete Button -->
    <button class="delete-button" onclick="showPopup()">Delete</button>

    <!-- Popup Modal -->
    <div id="popup" class="popup-modal">
        <div class="popup-content">
            <h2>WARNING</h2>
            <p>Selected movies will be permanently removed!</p>
            <div class="popup-actions">
                <button class="popup-back" onclick="closePopup()">Back</button>
                <button class="popup-delete" onclick="deleteMovies()">Delete</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Popups and Delete Functionality -->
    <script>
        function showPopup() {
            document.getElementById("popup").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        function deleteMovies() {
            let selectedMovies = document.querySelectorAll('.movie-select:checked');
            let movieIds = [];
            selectedMovies.forEach(movie => {
                movieIds.push(movie.getAttribute('data-id'));
            });
            
            if (movieIds.length > 0) {
                // Show loading alert while deleting
                alert("Deleting movies... Please wait!");

                fetch('Delete_api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ ids: movieIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Movies deleted successfully!");
                        location.reload(); // Reload to reflect changes
                    } else {
                        alert("Failed to delete movies: " + (data.message || "Unknown error"));
                    }
                })
                .catch(error => {
                    alert("Error occurred: " + error.message);
                })
                .finally(() => {
                    closePopup(); // Close the popup in any case
                });
            } else {
                alert("No movies selected.");
                closePopup(); // Close the popup if no movies selected
            }
        }
    </script>
</body>
</html>
