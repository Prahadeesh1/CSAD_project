<?php
header('Content-Type: application/json');
include 'db_connection.php'; 

$conn = connect_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $cast = $_POST['cast'];
    $director = $_POST['director'];
    $rating = $_POST['rating'];
    $genre = $_POST['genre'];
    $language = $_POST['language'];
    $subtitles = $_POST['subtitles'];
    $runtime = $_POST['runtime'];
    $synopsis = $_POST['synopsis'];
    $section = $_POST['section'];
    $theaters = $_POST['theaters'];
    $dates = $_POST['dates'];
    $id = $_POST['id'];

    // image shit
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['cover']['tmp_name']);
        $imageType = $_FILES['cover']['type'];
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error uploading image"
        ]);
        exit;
    }

    $query = "INSERT INTO movie_details (title, cast, director, rating, genre, language, subtitles, runtime, synopsis, section, theaters, dates, cover, cover_type,id)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Database error: " . $conn->error
        ]);
        exit;
    }

    $stmt->bind_param(
        "sssssssssssssss",

        $title,
        $cast,
        $director,
        $rating,
        $genre,
        $language,
        $subtitles,
        $runtime,
        $synopsis,
        $section,
        $theaters,
        $dates,
        $imageData,
        $imageType,
        $id
    );

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Movie added successfully"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to add movie: " . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();

    // fetch shit
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM movie_details";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $movies = [];
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['cover'])) {
                $row['cover'] = "data:" . $row['cover_type'] . ";base64," . base64_encode($row['cover']);
            }
            $movies[] = $row;
        }
        echo json_encode([
            "success" => true,
            "movies" => $movies
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No movies found"
        ]);
    }

    $conn->close();
}
?>
