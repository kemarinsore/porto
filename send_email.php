<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Pastikan data diterima via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Pengaturan server SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com';       // Server SMTP
        $mail->SMTPAuth   = true;                     // Aktifkan otentikasi SMTP
        $mail->Username   = 'aryaandika0@gmail.com';  // Alamat email pengirim
        $mail->Password   = 'fvwqmvmarrlmmhhk';       // Kata sandi SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Aktifkan enkripsi TLS implisit
        $mail->Port       = 465;                      // Port TLS

        // Penerima dan pengirim
        $mail->setFrom($email, $name);               // Set pengirim sesuai data form
        $mail->addAddress('aryaandika0@gmail.com', 'Owner'); // Tambahkan penerima (alamat Anda)

        // Konten email
        $mail->isHTML(true);                          // Mengirim email dalam format HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "<h3>New Message from Contact Form</h3>
                          <p><strong>Name:</strong> {$name}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Message:</strong><br>{$message}</p>";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
?>
