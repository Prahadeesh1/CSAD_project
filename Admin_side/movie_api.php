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

    $query2 = "SELECT theater_id FROM theater WHERE name = ?";
        $stmt2 = $conn->prepare($query2);
        if (!$stmt2) {
            echo json_encode([
                "success" => false,
                "message" => "Database error: " . $conn->error
            ]);
        }

        $stmt2->bind_param("s", $theaters);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $theater_id = $result->fetch_assoc()['theater_id'] ?? null;
        $stmt2->close();

    foreach($showtime as $date){
        $query3 = "INSERT INTO screenings (theater_id, id, show_time)
              VALUES (?, ?, ?)";
        $stmt3 = $conn->prepare($query3);
        if (!$stmt2) {
            echo json_encode([
                "success" => false,
                "message" => "Database error: " . $conn->error
            ]);
            exit;
        }
        $stmt3->bind_param(
            "iis",
            $theater_id,
            $id,
            $date,
        );

        if ($stmt3->execute()) {
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

    $query4 = "UPDATE screenings
                   SET `month` = DATE_FORMAT(show_time, '%b'),
                       `day` = DATE_FORMAT(show_time, '%e'),
                       `dayofWeek` = DATE_FORMAT(show_time, '%a'),
                       `time` = DATE_FORMAT(show_time, '%k%i')
                   WHERE id = ?";   
        $stmt4 = $conn->prepare($query4);
        $stmt4->bind_param("i", $id);
        $stmt4->execute();
        $stmt4->close();

    $stmt->close();
    $stmt3->close();
    $conn->close();

    // fetch shit
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $query1 = "SELECT * FROM movie_details";
    $result1 = $conn->query($query1);

    $query2 = "SELECT s.*, t.name AS theater_name 
           FROM screenings s
           JOIN theater t ON s.theater_id = t.theater_id";
    $result2 = $conn->query($query2);

    $query3 = "SELECT t.* FROM tickets t
                JOIN screenings s ON t.screening_id = s.screening_id";
    $result3 = $conn->query($query3);

    $movies = [];
    $screenings = [];
    $tickets = [];

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

    if ($result3 && $result3->num_rows > 0) {
        while ($row3 = $result3->fetch_assoc()) {
            $tickets[] = $row3;
        }
    }

    // Send JSON response
    echo json_encode([
        "success" => true,
        "movies" => $movies,       // Always return an array (even if empty)
        "screenings" => $screenings, // Always return an array (even if empty)
        "tickets" => $tickets // Always return an array (even if empty)
    ]);

    $conn->close();
}

?>
