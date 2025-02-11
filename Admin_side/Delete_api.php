<?php
ini_set('display_errors', 1);  //  error display
error_reporting(E_ALL);         // Report errors

header('Content-Type: application/json');
require 'db_connection.php';

$conn = connect_db();  

// the POST data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['ids']) && is_array($data['ids'])) {
    // Fetch movie IDs
    $ids = $data['ids'];

    //Log the IDs for troubleshooting
    error_log("Received IDs: " . implode(", ", $ids));

    //prepare the SQL query to delete movies by ID
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM movie_details WHERE id IN ($placeholders)";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        //  type  s for string
        $types = str_repeat('s', count($ids)); // 's' for each string ID
        
        // Bind parameters dynamically
        $stmt->bind_param($types, ...$ids);

        // Log the SQL and parameters
        error_log("SQL Query: " . $sql);
        error_log("Parameters: " . implode(", ", $ids));

        // Execute statement
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
