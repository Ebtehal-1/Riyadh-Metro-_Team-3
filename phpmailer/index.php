<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userEmail = $_POST['email']; // Get user's email
    $startingStation = $_POST['starting_station']; // Get starting station
    $destinationStation = $_POST['destination_station']; // Get destination station
    $travelDate = $_POST['travel_date']; // Get travel date
    $class = $_POST['class']; // Get class
    $paymentMethod = $_POST['payment']; // Get payment method
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV['EMAIL_USER'];                     //SMTP username
    $mail->Password   = $_ENV['EMAIL_PASS'];                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

     $mail->CharSet = 'UTF-8';
    //Recipients
    $mail->setFrom('swproject25@gmail.com', 'Riyadh Metro project');
    $mail->addAddress($userEmail);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('swproject25@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'تأكيد الحجز';
    $mail->Body    = "
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
                <span style='display: block; font-weight: bold; color: #333;'>Class:</span>
                $class
            </div>
            <div style='margin-bottom: 10px;'>
                <span style='display: block; font-weight: bold; color: #333;'>Payment Method:</span>
                $paymentMethod
            </div>
            <div style='text-align: center; margin-top: 20px; font-size: 12px; color: #777;'>
                Thank you for choosing Riyadh Metro!
            </div>
        </div>";
    // $mail->AltBody = 'entsThis is the body in plain text for non-HTML mail cli';

    $mail->send();
    echo 'Your ticket has been sent to your email';
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
                    <span style='display: block; font-weight: bold; color: #333;'>Class:</span>
                    $class
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
}}