<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // PHPMailer install korle eta use korte hobe
// echo "This is a test message."; return;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_form_submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $appointment = $_POST['appointment'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'qmartsoft.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@qmartsoft.com'; // Tomar Gmail email
        $mail->Password = 'VN+~r5;wOqY]'; // Tomar Gmail password ba App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
        $mail->Port = 465; // SSL port

        // Sender and Recipient
        $mail->setFrom('info@qmartsoft.com', 'Contact Form');
        $mail->addAddress('wholeomarfaruk@gmail.com', 'Contact Form'); // Email ta jehetu tomar Gmail e jabe

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "<h3>Message from $name ($email - $phone)</h3><p>Customer Appoinment request for $appointment</p>";

        // Send Email
        if ($mail->send()) {
            echo $mail_status = "Your message has been sent successfully!";
        } else {
            echo  $mail_error = "Message could not be sent.";
        }
    } catch (Exception $e) {
        echo $mail_error="Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
