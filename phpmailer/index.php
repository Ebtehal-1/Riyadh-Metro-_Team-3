<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = $_POST['email']; // Get user's email
    $startingStation = $_POST['starting_station']; // Get starting station
    $destinationStation = $_POST['destination_station']; // Get destination station
    $travelDate = $_POST['travel_date']; // Get travel date
    $travel_time =$_POST['travel_time'];
    $paymentMethod = $_POST['payment']; // Get payment method
    $total_price = $_POST['total_price'];

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server setting
        $mail->isSMTP();   
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                          // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = SMTP_USERNAME;               // SMTP username
        $mail->Password   = SMTP_PASSWORD;                          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to
        $mail->CharSet    = 'UTF-8';                                // Set character encoding to UTF-8
      // ✅ حل مشكلة SSL: تعطيل التحقق من الشهادة
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
       // تصحيح الترميز
       $mail->CharSet = 'UTF-8';
       $mail->Encoding = 'base64';
        // Recipients
        $mail->setFrom('swproject25@gmail.com', 'Riyadh Metro Project');
        $mail->addAddress($userEmail);                              // Add user's email as recipient

        // Email content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'تأكيد الحجز';

        // Construct the email body (HTML ticket)
        $mail->Body = "
        <div style='max-width: 400px; margin: 20px auto; padding: 20px; background-color: #ffffff; border: 2px dashed #ccc; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: left; font-family: Arial, sans-serif;'>
            <div style='text-align: center; font-size: 20px; font-weight: bold; color: #444; margin-bottom: 20px;'>
                Riyadh Metro Ticket
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Starting Station:</span>
                $startingStation
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Destination Station:</span>
                $destinationStation
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Travel Date:</span>
                $travelDate
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Travel Time:</span>
                $travel_time
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Price: SAR</span>
                $total_price 
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Payment Method:</span>
                $paymentMethod
            </div>
            <div style='text-align: center; margin-top: 20px; font-size: 12px; color: #777;'>
                Thank you for choosing Riyadh Metro!
            </div>
        </div>";

        // Send the email
        $mail->send();
        echo "<p>Your ticket has been sent to your email.</p>";

        // Display the ticket on the page
        echo "
        <div style='max-width: 400px; margin: 20px auto; padding: 20px; background-color: #ffffff; border: 2px dashed #ccc; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: left; font-family: Arial, sans-serif;'>
            <div style='text-align: center; font-size: 20px; font-weight: bold; color: #444; margin-bottom: 20px;'>
                Riyadh Metro Ticket
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Starting Station:</span>
                $startingStation
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Destination Station:</span>
                $destinationStation
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Travel Date:</span>
                $travelDate
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Travel Time:</span>
                $travel_time
            </div>
                     <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Price: SAR</span>
                $total_price 
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Payment Method:</span>
                $paymentMethod
            </div>
            <div style='text-align: center; margin-top: 20px; font-size: 12px; color: #777;'>
                Thank you for choosing Riyadh Metro!
            </div>
        </div>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
