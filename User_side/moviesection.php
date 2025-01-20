<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="CSS/user_movies.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }
        .navbar nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .navbar nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .movie-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .movie-card:hover {
            transform: translateY(-5px);
        }
        .movie-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .movie-info {
            padding: 15px;
        }
        .movie-title {
            font-size: 20px;
            margin: 0 0 10px;
        }
        .movie-details {
            color: #555;
            font-size: 14px;
        }
        .movie-details span {
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<!-- Header Navigation -->
<div class="navbar">
    <img src="images/logo.png" alt="Logo" height="40">
    <nav>
        <a href="main_page.html">Home</a>
        <a href="#">Movies</a>
        <a href="#">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
    </nav>
</div>

<!-- Movies Section -->
<div class="container">
    <div class="search-bar">
        <input type="text" id="searchBar" placeholder="Search movies...">
    </div>
    <div class="movie-grid" id="movieGrid">
        <!-- Movies will be loaded dynamically here -->
    </div>
</div>

<script>
    // Fetch movies from the API and display them
    async function fetchMovies() {
        try {
            const response = await fetch('movie_api.php'); // Replace with your API endpoint
            const movies = await response.json();

            const movieGrid = document.getElementById('movieGrid');
            movieGrid.innerHTML = '';

            movies.forEach(movie => {
                const movieCard = document.createElement('div');
                movieCard.classList.add('movie-card');

                movieCard.innerHTML = `
                    <img src="${movie.cover}" alt="${movie.title}">
                    <div class="movie-info">
                        <h3 class="movie-title">${movie.title}</h3>
                        <div class="movie-details">
                            <span><strong>Genre:</strong> ${movie.genre}</span>
                            <span><strong>Rating:</strong> ${movie.rating}</span>
                            <span><strong>Language:</strong> ${movie.language}</span>
                            <span><strong>Schedule:</strong> ${movie.schedule}</span>
                        </div>
                    </div>
                `;

                movieGrid.appendChild(movieCard);
            });
        } catch (error) {
            console.error('Error fetching movies:', error);
        }
    }

    // Search functionality
    document.getElementById('searchBar').addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const movieCards = document.querySelectorAll('.movie-card');

        movieCards.forEach(card => {
            const title = card.querySelector('.movie-title').textContent.toLowerCase();
            card.style.display = title.includes(searchTerm) ? '' : 'none';
        });
    });

    // Load movies on page load
    window.onload = fetchMovies;
</script>

</body>
</html>
