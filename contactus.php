<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Set up recipient email address
    $to = "parikshatime.com"; // Replace with your own email address

    // Set up email subject and body
    $subject = "Contact Form Submission";
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message";

    // Set up headers
    $headers = "From: $email";

    // Attempt to send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
}
?>
