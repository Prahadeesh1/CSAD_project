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
    $showtime = explode(',', $dates);
    

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

    $query1 = "INSERT INTO movie_details (title, cast, director, rating, genre, language, subtitles, runtime, synopsis, section, cover, cover_type)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query1);

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Database error: " . $conn->error
        ]);
        exit;
    }

    $stmt->bind_param(
        "ssssssssssss",

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
        $imageData,
        $imageType,
    );

    if ($stmt->execute()) {

        $id = $stmt->insert_id; // get the id of the inserted movie

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

    foreach($showtime as $date){
        $query2 = "INSERT INTO screenings (theater, id, show_time)
              VALUES (?, ?, ?)";
        $stmt2 = $conn->prepare($query2);
        if (!$stmt2) {
            echo json_encode([
                "success" => false,
                "message" => "Database error: " . $conn->error
            ]);
            exit;
        }
        $stmt2->bind_param(
            "sis",
            $theaters,
            $id,
            $date,
        );

        if ($stmt2->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Screenings added successfully"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Failed to add movie: " . $stmt2->error
            ]);
        }
    }

    $query3 = "UPDATE screenings
                   SET `month` = DATE_FORMAT(show_time, '%b'),
                       `day` = DATE_FORMAT(show_time, '%e'),
                       `dayofWeek` = DATE_FORMAT(show_time, '%a'),
                       `time` = DATE_FORMAT(show_time, '%k%i')
                   WHERE id = ?";   
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("i", $id);
        $stmt3->execute();
        $stmt3->close();

    $stmt->close();
    $stmt2->close();
    $conn->close();

    // fetch shit
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $query1 = "SELECT * FROM movie_details";
    $result1 = $conn->query($query1);

    $query2 = "SELECT * FROM screenings";
    $result2 = $conn->query($query2);

    $movies = [];
    $screenings = [];

    // Fetch movies if available
    if ($result1 && $result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            if (!empty($row1['cover'])) {
                $row1['cover'] = "data:" . $row1['cover_type'] . ";base64," . base64_encode($row1['cover']);
            }
            $movies[] = $row1;
        }
    }

    // Fetch screenings if available
    if ($result2 && $result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $screenings[] = $row2;
        }
    }

    // Send JSON response
    echo json_encode([
        "success" => true,
        "movies" => $movies,       // Always return an array (even if empty)
        "screenings" => $screenings // Always return an array (even if empty)
    ]);

    $conn->close();
}

?>
