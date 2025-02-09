<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include PHPMailer classes
require 'C:\xampp\htdocs\CSAD_project_main\vendor\phpmailer\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\CSAD_project_main\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\CSAD_project_main\vendor\phpmailer\phpmailer\src\SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $movie = $_POST['movie'];
    $theater = $_POST['theater'];
    $seats = $_POST['seats'];
    $showtime = $_POST['showtime'];
    $price = $_POST['price'];

    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prahadeeshh123457@gmail.com'; // Your Gmail
        $mail->Password = 'dnjq lmdg dxwf xnkw'; // Replace with App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('prahadeeshh123457@gmail.com', 'PrismVerse Cinematics');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Your Movie Ticket Confirmation";
        $mail->Body = "
            <h2>Booking Confirmation</h2>
            <p>Thank you for booking with PrismVerse Cinematics!</p>
            <p><strong>Movie:</strong> $movie</p>
            <p><strong>Theater:</strong> $theater</p>
            <p><strong>Seats:</strong> $seats</p>
            <p><strong>Showtime:</strong> $showtime</p>
            <p><strong>Total Price:</strong> $$price</p>
            <p>Enjoy your movie!</p>
        ";

        $mail->send();
        echo json_encode(["success" => true, "message" => "Email sent successfully"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
