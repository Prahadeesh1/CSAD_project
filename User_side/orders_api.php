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

        $query3 = "SELECT theater_id FROM theater WHERE name = ?";
        $stmt3 = $conn->prepare($query3);
        if (!$stmt3) {
            throw new Exception("Database error: " . $conn->error);
        }
        $stmt3->bind_param("s", $theater);
        $stmt3->execute();
        $result = $stmt3->get_result();
        $theater_id = $result->fetch_assoc()["theater_id"] ?? null;
        $stmt3->close();

        if (!$theater_id) {
            throw new Exception("Theater not found");
        }

        // Retrieve Screening ID
        $query4 = "SELECT screening_id FROM screenings WHERE theater_id = ? AND id = ? AND show_time = ?";
        $stmt4 = $conn->prepare($query4);
        if (!$stmt4) {
            throw new Exception("Database error: " . $conn->error);
        }

        $stmt4->bind_param("iis", $theater_id, $movie_id, $showtime);
        $stmt4->execute();
        $result = $stmt4->get_result();
        $screening_id = $result->fetch_assoc()['screening_id'] ?? null;
        $stmt4->close();

        if (!$screening_id) {
            throw new Exception("Screening not found");
        }

        // Insert Tickets
        $stmt5 = $conn->prepare("INSERT INTO tickets (customer_id, screening_id, seat_number, cost) VALUES (?, ?, ?, ?)");
        if (!$stmt5) {
            throw new Exception("Prepared statement error: " . $conn->error);
        }

        $stmt5->bind_param("iiss", $customer_id, $screening_id, $seats, $price);

        if (!$stmt5->execute()) {
            throw new Exception("Error executing insert: " . $stmt5->error);
        }

        $ticket_id = $stmt5->insert_id;
        $stmt5->close();
        
        // **Commit Transaction** if all queries were successful
        $conn->commit();
        $payment_url_with_ticket = $stripeUrls[$price] . "?ticket_id=" . $ticket_id . "&status=pending";
        echo json_encode(["success" => true, "payment_url" => $payment_url_with_ticket]);
        exit;

    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $query = "SELECT 
            ti.ticket_id, 
            ti.seat_number, 
            ti.cost, 
            s.screening_id, 
            s.theater_id, 
            s.month, 
            s.day, 
            s.dayofWeek, 
            s.time, 
            m.id AS movie_id, 
            m.title, 
            m.cover, 
            th.name AS theater_name 
        FROM tickets ti
        JOIN screenings s ON ti.screening_id = s.screening_id
        JOIN movie_details m ON s.id = m.id
        JOIN theater th ON s.theater_id = th.theater_id";

        $result = $conn->query($query);
    
        $ticket = [];
    
        // Fetch movies if available
        if ($result && $result->num_rows > 0) {
            while ($row1 = $result->fetch_assoc()) {
                $ticket[] = $row1;
            }
        }
    
        // Send JSON response
        echo json_encode([
            "success" => true,
            "ticket" => $ticket,       // Always return an array (even if empty)
        ]);
    
        $conn->close();
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
