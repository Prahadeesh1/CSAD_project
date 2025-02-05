<?php
ini_set('display_errors', 1);  // Enable error display for debugging
error_reporting(E_ALL);         // Report all errors

header('Content-Type: application/json');
require 'db_connection.php'; // Ensure your DB connection is correct

$conn = connect_db();  // Assuming connect_db() is a function to establish the MySQLi connection

// Get the POST data (movie IDs to delete)
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['ids']) && is_array($data['ids'])) {
    // Fetch the array of movie IDs
    $ids = $data['ids'];

    // Debug: Log the received IDs for troubleshooting
    error_log("Received IDs: " . implode(", ", $ids));

    // Sanitize and prepare the SQL query to delete movies by ID
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM movie_details WHERE id IN ($placeholders)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Prepare the type for the bind_param, 's' for string as id is a string in your case
        $types = str_repeat('s', count($ids)); // 's' for each string ID
        
        // Bind the parameters dynamically
        $stmt->bind_param($types, ...$ids);

        // Debug: Log the SQL and parameters
        error_log("SQL Query: " . $sql);
        error_log("Parameters: " . implode(", ", $ids));

        // Execute the statement
        if ($stmt->execute()) {
            // Successful deletion
            echo json_encode(["success" => true, "message" => "Movies deleted successfully"]);
        } else {
            // Error during deletion
            error_log("Delete failed: " . json_encode($stmt->errorInfo()));
            echo json_encode(["success" => false, "message" => "Failed to delete movies"]);
        }
    } else {
        // Error preparing the SQL statement
        error_log("SQL preparation error: " . json_encode($conn->error));
        echo json_encode(["success" => false, "message" => "SQL error"]);
    }
} else {
    // Invalid input data
    error_log("Invalid request: " . json_encode($data));
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
