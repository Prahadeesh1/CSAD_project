<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movies</title>
    <link rel="stylesheet" href="CSS/Add_movie.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>

<!-- Back Button -->
<button class="back-button" onclick="document.location='Movie_Sections.html'">Back to Sections</button>

<!-- Headline -->
<h1>Add Movies</h1>

<!-- Form Layout -->
<div class="form-container">
    <form action="movie_api.php" method="POST" enctype="multipart/form-data">
        <!-- Cover Section -->
        <div class="cover-container">
            <label for="upload-cover" class="add-cover">
                <input type="file" id="upload-cover" accept="image/*" name="cover" required />
                Add Cover
            </label>
            <img id="cover-preview" src="" alt="Cover Image" />

            <!-- Dropdown for Sections -->
            <label class="dropdown-title">Movie Sections</label>
            <select name="section" class="dropdown">
                <option value="Now Showing">Now Showing</option>
                <option value="Advanced Sales">Advanced Sales</option>
            </select>

            <!-- Dropdown for Theaters -->
            <label class="dropdown-title">Add Theaters</label>
            <input type="text">

        </div>

        <!-- Date and Time Picker -->
        <label class="dropdown-title">Select Dates and Times</label>
        <input type="text" id="dateTimePicker" name="dates" placeholder="Select Dates and Times">

        <!-- Movie Form -->
        <div class="movie-form">
            <textarea name="id" placeholder="Enter movie ID" rows="2"></textarea>
            <textarea name="title" placeholder="Enter Movie Title" rows="1" required></textarea>
            <textarea name="cast" placeholder="Enter Cast" rows="2"></textarea>
            <textarea name="director" placeholder="Enter Director" rows="1"></textarea>
            <textarea name="rating" placeholder="Enter Movie Rating" rows="1"></textarea>
            <textarea name="genre" placeholder="Enter Movie Genre" rows="1"></textarea>
            <textarea name="language" placeholder="Enter Movie Language" rows="1"></textarea>
            <textarea name="subtitles" placeholder="Enter Movie Subtitles" rows="1"></textarea>
            <textarea name="runtime" placeholder="Enter Movie Runtime (mins)" rows="1"></textarea>
            <textarea name="synopsis" placeholder="Enter Movie Synopsis" rows="5"></textarea>
            <button type="submit" class="add-button">Add</button>
        </div>
    </form>
</div>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#dateTimePicker", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        mode: "multiple",
        time_24hr: true,
        minDate: "today"
    });
</script>
<script>
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
