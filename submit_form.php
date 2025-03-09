<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input to prevent XSS and other security vulnerabilities
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check if the form fields are not empty
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare the email
    $to = "your-Info.snconstruction@gmail.com";  // Replace with your own email address
    $subject = "New Message from Contact Form";
    $body = "You have received a new message from $name ($email):\n\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your message. We will get back to you soon!";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
