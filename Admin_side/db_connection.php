<?php
function connect_db() {
    $username = "root"; 
    $servername = "localhost";
    $password = "";            
    $dbname = "csad";          
    // Create a new database connection
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
