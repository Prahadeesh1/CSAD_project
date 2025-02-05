<?php
include "db_connection.php";

$conn = connect_db();

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Movie ID not provided. Check your URL.");
}

$movie_id = $_GET['id'];

// Fetch movie details
$query = "SELECT * FROM movie_details WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Error: Movie not found.");
}

$movie = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $cast = $_POST["cast"];
    $director = $_POST["director"];
    $rating = $_POST["rating"];
    $genre = $_POST["genre"];
    $language = $_POST["language"];
    $subtitles = $_POST["subtitles"];
    $runtime = $_POST["runtime"];
    $synopsis = $_POST["synopsis"];
    $section = $_POST["section"];

    // Update query
    $update_query = "UPDATE movie_details SET 
        title=?, cast=?, director=?, rating=?, genre=?, language=?, subtitles=?, runtime=?, synopsis=?, section=?
        WHERE id=?";
    
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssssssss", $title, $cast, $director, $rating, $genre, $language, $subtitles, $runtime, $synopsis, $section, $movie_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Movie updated successfully!'); window.location='Edit_movies.php';</script>";
    } else {
        echo "Error updating movie: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movies Details</title>
    <link rel="stylesheet" href="CSS/Edit_details.css">
</head>
<body>

<!-- Back Button -->
<button class="back-button" onclick="document.location='Edit_movies.php'">Back to Edit</button>

<!-- Headline -->
<h1>Edit Movies Details</h1>

<!-- Form Layout -->
<div class="form-container">
    <!-- Cover Section -->
    <div class="cover-container">
        <label for="upload-cover" class="add-cover">
            <input type="file" id="upload-cover" accept="image/*" />
            Edit Cover
        </label>
        <img id="cover-preview" src="" alt="Cover Image" />

        <!-- Dropdown for Sections -->
        <label class="dropdown-title">Movie Sections</label>
        <div class="dropdown single-select">
            <div class="select">
                <span class="selected"><?php echo $movie['section']; ?></span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <li class="<?php echo $movie['section'] == 'Now Showing' ? 'active' : ''; ?>">Now Showing</li>
                <li class="<?php echo $movie['section'] == 'Advanced Sales' ? 'active' : ''; ?>">Advanced Sales</li>
            </ul>
        </div>
    </div>

    <!-- Movie Form -->
    <div class="movie-form">
        <form method="POST">
            <div class="form-group">
                <textarea name="title" placeholder="Edit Movie Title" rows="1"><?php echo $movie['title']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="cast" placeholder="Edit Cast" rows="2"><?php echo $movie['cast']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="director" placeholder="Edit Director" rows="1"><?php echo $movie['director']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="rating" placeholder="Edit Movie Rating" rows="1"><?php echo $movie['rating']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="genre" placeholder="Edit Movie Genre" rows="1"><?php echo $movie['genre']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="language" placeholder="Edit Movie Language" rows="1"><?php echo $movie['language']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="subtitles" placeholder="Edit Movie Subtitles" rows="1"><?php echo $movie['subtitles']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="runtime" placeholder="Edit Movie Runtime (mins)" rows="1"><?php echo $movie['runtime']; ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="synopsis" placeholder="Edit Movie Synopsis" rows="5"><?php echo $movie['synopsis']; ?></textarea>
            </div>
            <input type="hidden" name="section" id="selected-section" value="<?php echo $movie['section']; ?>">
            <button type="submit" class="add-button">Update</button>
        </form>
    </div>
</div>

<script>
    // Dropdown functionality
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        const select = dropdown.querySelector('.select');
        const caret = dropdown.querySelector('.caret');
        const menu = dropdown.querySelector('.menu');
        const selected = dropdown.querySelector('.selected');
        const hiddenInput = document.getElementById('selected-section');

        select.addEventListener('click', () => {
            menu.classList.toggle('menu-open');
            caret.classList.toggle('caret-rotate');
        });

        menu.querySelectorAll('li').forEach(option => {
            option.addEventListener('click', () => {
                selected.textContent = option.textContent;
                hiddenInput.value = option.textContent;
                menu.querySelectorAll('li').forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                menu.classList.remove('menu-open');
                caret.classList.remove('caret-rotate');
            });
        });
    });

    // Cover preview functionality
    const fileInput = document.getElementById('upload-cover');
    const preview = document.getElementById('cover-preview');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>

</body>
</html>