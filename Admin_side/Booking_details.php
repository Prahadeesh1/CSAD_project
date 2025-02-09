<?php
include 'db_connection.php'; // Include database connection
$conn = connect_db();
$sql = "SELECT 
    t.ticket_id AS ID, 
    s.show_time AS DateTime, 
    m.title AS Movie, 
    t.seat_number AS Seats 
FROM tickets t
INNER JOIN screenings s ON t.screening_id = s.screening_id  -- Connect tickets to screenings
INNER JOIN movie_details m ON s.id = m.id;  -- Connect screenings to movie_details
  -- Ensuring tickets link to movie_details correctly
 -- Use `id` instead of `title`
"; 

$result = $conn->query($sql);

// Debugging: Check if query execution failed
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="CSS/Customer_detail.css">
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
    <h1>Movie Booking Details</h1>

    <!-- Back Button -->
    <button class="back-button" onclick="document.location='Customer_details.html'">Back to Customers</button>

<table class="customer-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date & Time</th>
            <th>Movie</th>
            <th>Seats</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['DateTime']}</td>
                    <td>{$row['Movie']}</td>
                    <td>{$row['Seats']}</td>
                    <td>
                        <button class='delete-btn' onclick='showPopup({$row['ID']})'>Delete</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>"; // Updated colspan to match the new column
    }
    ?>
</tbody>
</table>
<script>
function showPopup(ticketId) {
    if (confirm("Are you sure you want to delete this ticket?")) {
        window.location.href = `delete_ticket.php?id=${ticketId}`;
    }
}

</script>

</body>
</html>

<?php $conn->close(); ?>
