<?php
header('Content-Type: application/json');
include 'db_connection.php';

$conn = connect_db();

// Start Transaction
$conn->begin_transaction();

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $movie = $_POST['movie'];
        $theater = $_POST['theater'];
        $showtime = $_POST['showtime'];
        $seats = $_POST['seats'];
        $price = (int)$_POST['price'];

        $stripeUrls = [
            10 => "https://buy.stripe.com/test_6oE7to0em3L3da0144",
            20 => "https://buy.stripe.com/test_3cs294aT0bdv2vm145",
            30 => "https://buy.stripe.com/test_cN2aFAbX481j4DueUW",
            40 => "https://buy.stripe.com/test_28o00W7GO0yRee428b",
            50 => "https://buy.stripe.com/test_5kA5lg8KS5Tb9XOfZ2",
            60 => "https://buy.stripe.com/test_7sI7togdk2GZ5HyfZ3",
            70 => "https://buy.stripe.com/test_6oEfZUf9gepH3zqaEK",
            80 => "https://buy.stripe.com/test_9AQ5lgbX4dlD3zq9AH",
            90 => "https://buy.stripe.com/test_aEU9Bw4uCchz2vmdQZ",
            100 => "https://buy.stripe.com/test_8wM00Wf9gftL8TK28g"
        ];

        if (!isset($stripeUrls[$price])) {
            echo json_encode(["success" => false, "message" => "Invalid price selection."]);
            exit;
        }


        // Insert Customer Details
        $query1 = "INSERT INTO customer_details (first_name, last_name, email, phone_number) VALUES (?, ?, ?, ?)";
        $stmt1 = $conn->prepare($query1);
        if (!$stmt1) {
            throw new Exception("Database error: " . $conn->error);
        }

        $stmt1->bind_param("ssss", $fname, $lname, $email, $number);
        $stmt1->execute();
        $customer_id = $stmt1->insert_id;
        $stmt1->close();

        // Retrieve Movie ID
        $query2 = "SELECT id FROM movie_details WHERE title = ?";
        $stmt2 = $conn->prepare($query2);
        if (!$stmt2) {
            throw new Exception("Database error: " . $conn->error);
        }

        $stmt2->bind_param("s", $movie);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $movie_id = $result->fetch_assoc()['id'] ?? null;
        $stmt2->close();

        if (!$movie_id) {
            throw new Exception("Movie not found");
        }

        // Retrieve Screening ID
        $query3 = "SELECT id FROM screenings WHERE theater = ? AND id = ? AND show_time = ?";
        $stmt3 = $conn->prepare($query3);
        if (!$stmt3) {
            throw new Exception("Database error: " . $conn->error);
        }

        $stmt3->bind_param("sis", $theater, $movie_id, $showtime);
        $stmt3->execute();
        $result = $stmt3->get_result();
        $screening_id = $result->fetch_assoc()['id'] ?? null;
        $stmt3->close();

        if (!$screening_id) {
            throw new Exception("Screening not found");
        }

        // Insert Tickets
        $stmt4 = $conn->prepare("INSERT INTO tickets (customer_id, screening_id, seat_number, cost, payment) VALUES (?, ?, ?, ?, 0)");
        if (!$stmt4) {
            throw new Exception("Database error: " . $conn->error);
        }

        $stmt4->bind_param("iiss", $customer_id, $screening_id, $seats, $price);
        $stmt4->execute();
        $stmt4->close();

        // **Commit Transaction** if all queries were successful
        $conn->commit();

        echo json_encode(["success" => true, "payment_url" => $stripeUrls[$price]]);
        exit;
    }
} catch (Exception $e) {
    // **Rollback Transaction** if any query fails
    $conn->rollback();
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    exit;
} finally {
    
    // Close the connection
    $conn->close();
}
?>
