<?php
include 'db_connection.php'; 

$conn = connect_db();


if (isset($_GET["id"])) {
    $ticket_id = intval($_GET["id"]); // Convert to integer 

    // Prepare SQL statement
    $stmt = $conn->prepare("DELETE FROM tickets WHERE ticket_id = ?");
    $stmt->bind_param("i", $ticket_id);

    if ($stmt->execute()) {
        // Redirec deletion
        header("Location: Customer_details.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close(); // Close statement
}

$conn->close(); // Close DB connection
?>
