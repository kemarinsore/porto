<?php
use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload Composer untuk PHPMailer dan Dotenv

// Muat file .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail = new PHPMailer(true);
            try {
                // Konfigurasi SMTP
                $mail->isSMTP();
                $mail->Host = $_ENV['MAIL_HOST']; // Ambil dari .env
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['MAIL_USERNAME']; // Ambil dari .env
                $mail->Password = $_ENV['MAIL_PASSWORD']; // Ambil dari .env
                $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION']; // Ambil dari .env
                $mail->Port = $_ENV['MAIL_PORT']; // Ambil dari .env

                // Detail email
                $mail->setFrom($_ENV['MAIL_USERNAME'], 'Portfolio Website');
                $mail->addAddress('aryaandika0@gmail.com'); // Ganti dengan email penerima
                $mail->Subject = "Message from $name via Portfolio";
                $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

                // Kirim email
                $mail->send();
                echo "<script>alert('Email sent successfully!'); window.location.href = 'index.html';</script>";
            } catch (Exception $e) {
                error_log("PHPMailer Error: " . $mail->ErrorInfo);
                echo "<script>alert('Failed to send email. Please try again later.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Invalid email address.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
