<?php
header('Content-Type: application/json');
include 'db_connection.php'; 

$conn = connect_db();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if this is an update
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

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
        $dates = $_POST['dates'];

        $imageData = null;
        $imageType = null;

        // Handle cover image if provided
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['cover']['tmp_name']);
            $imageType = $_FILES['cover']['type'];
        }

        // Build the query dynamically to handle optional image updates
        if ($imageData) {
            $query = "UPDATE movie_details 
                      SET title = ?, cast = ?, director = ?, rating = ?, genre = ?, language = ?, subtitles = ?, runtime = ?, synopsis = ?, section = ?, dates = ?, cover = ?, cover_type = ? 
                      WHERE id = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                echo json_encode([
                    "success" => false,
                    "message" => "Database error: " . $conn->error
                ]);
                exit;
            }

            $stmt->bind_param(
                "sssssssssssssi",
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
                $dates,
                $imageData,
                $imageType,
                $id
            );
        } else {
            $query = "UPDATE movie_details 
                      SET title = ?, cast = ?, director = ?, rating = ?, genre = ?, language = ?, subtitles = ?, runtime = ?, synopsis = ?, section = ?, dates = ? 
                      WHERE id = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                echo json_encode([
                    "success" => false,
                    "message" => "Database error: " . $conn->error
                ]);
                exit;
            }

            $stmt->bind_param(
                "ssssssssssssi",
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
                $dates,
                $id
            );
        }

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Movie updated successfully"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Failed to update movie: " . $stmt->error
            ]);
        }

        $stmt->close();
        $conn->close();
        exit;
    }
}    

if ($_SERVER['REQUEST_METHOD'] === 'PsOST') {

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

    $query = "INSERT INTO movie_details (title, cast, director, rating, genre, language, subtitles, runtime, synopsis, section, dates, cover, cover_type,id)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Database error: " . $conn->error
        ]);
        exit;
    }

    $stmt->bind_param(
        "ssssssssssssss",

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