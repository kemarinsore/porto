<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Memuat file autoload PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input dari form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Instansiasi PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Pengaturan server email (misal: SMTP)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Ganti dengan SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'youremail@gmail.com'; // Ganti dengan email kamu
        $mail->Password = 'yourpassword'; // Ganti dengan password email kamu
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Pengaturan penerima dan pengirim email
        $mail->setFrom('youremail@gmail.com', 'Your Name');  // Email pengirim
        $mail->addAddress('aryaandika0@gmail.com');  // Email penerima

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";  // Jika email client tidak mendukung HTML

        // Kirim email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
