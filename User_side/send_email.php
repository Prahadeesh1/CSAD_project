<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include Composer's autoload file
require 'C:\xampp\htdocs\CSAD_project_main\vendor\autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $name = ucfirst(strtolower(trim($_POST['booking-name'] ?? 'Unknown User'))); // Capitalize the name
    $recipient_email = $_POST['booking-email'] ?? null;
    $phone = $_POST['booking-phone'] ?? 'Not provided';
    $event_type = $_POST['booking-category'] ?? 'Not specified';
    $other_event = $_POST['other-event'] ?? '';
    $pax = $_POST['booking-pax'] ?? 'Not specified';
    $location = $_POST['booking-location'] ?? 'Not specified';
    $event_date = $_POST['booking-date'] ?? 'Not specified';
    $event_time = $_POST['booking-time'] ?? 'Not specified';

    // Handle missing email address
    if (!$recipient_email) {
        die('❌ Email address is missing from the form.');
    }

    // Check if "Other" event type is selected
    if ($event_type === 'Others' && !empty($other_event)) {
        $event_type .= " ($other_event)";
    }

    // Your email credentials
    $sender_email = 'prahadeeshh123457@gmail.com';
    $sender_password = 'dnjq lmdg dxwf xnkw'; // Replace with app password

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $sender_email;
        $mail->Password = $sender_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($sender_email, 'PrismVerse Cinematics');
        $mail->addAddress($recipient_email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; padding: 20px; background: linear-gradient(135deg, red, black); color: white; border-radius: 10px;'>
                <h1 style='text-align: center; margin-bottom: 20px;'>PrismVerse Cinematics</h1>
                <h2 style='text-align: center;'>Booking Confirmation</h2>
                <p style='font-size: 16px;'>Hello <strong>$name</strong>,</p>
                <p style='font-size: 16px; color:white;'>Thank you for booking with us. Below are the details of your booking:</p>
                <table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>
                    <tr style='background-color: #333; color: white;'>
                        <th style='padding: 10px; border: 1px solid #555;'>Field</th>
                        <th style='padding: 10px; border: 1px solid #555;'>Details</th>
                    </tr>
                    <tr style='background-color: #444;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Contact Name:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$name</td>
                    </tr>
                    <tr style='background-color: #555;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Email Address:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$recipient_email</td>
                    </tr>
                    <tr style='background-color: #444;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Contact Number:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$phone</td>
                    </tr>
                    <tr style='background-color: #555;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Event Type:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$event_type</td>
                    </tr>
                    <tr style='background-color: #444;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Number of Pax:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$pax</td>
                    </tr>
                    <tr style='background-color: #555;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Cinema Location:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$location</td>
                    </tr>
                    <tr style='background-color: #444;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Date of Event:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$event_date</td>
                    </tr>
                    <tr style='background-color: #555;'>
                        <td style='padding: 10px; border: 1px solid #555;'>Time of Event:</td>
                        <td style='padding: 10px; border: 1px solid #555;'>$event_time</td>
                    </tr>
                </table>
                <p style='font-size: 16px; margin-top: 20px; color:white;'>If you have any questions or changes to your booking, please contact us.</p>
                <p style='text-align: center; font-size: 14px; margin-top: 20px; color:white;'>Best regards,<br><strong>PrismVerse Cinematics Team</strong></p>
            </div>
        ";

        // Send email
        if ($mail->send()) {
            echo '✅ Confirmation email sent successfully!';
        } else {
            echo '❌ Failed to send email.';
        }
    } catch (Exception $e) {
        echo "❌ Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo '❌ Invalid request method. Please submit the form.';
}
?>
