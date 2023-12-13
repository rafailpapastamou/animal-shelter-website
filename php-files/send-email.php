<?php include("../../php-files/connect.php"); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["text"];

    // Set the recipient email address
    $to = "animal.shelter.lab2324@gmail.com";

    // Set the email subject
    $subject = "Νέο εισερχόμενο μήνυμα μέσω της φόρμας επικοινωνίας!";

    // Compose the email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Message:\n$message";

    // Set additional headers
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $email_message, $headers)) {
        // Email sent successfully
        echo "success";
    } else {
        // Email sending failed
        echo "error";
    }
} else {
    // Handle the case where the form is not submitted via POST
    echo "Invalid request.";
}

?>