<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the email address
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Ensure the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit;
    }

    // Your email content
    $subject = "Notification from FoodBridge";
    $message = "Hello Donor,\n\nThank you for your contribution to FoodBridge. Your donation has made a difference in someone's life.\n\nSincerely,\nFoodBridge Team";

    // Set the sender email address
    $from = "pratheeksharaju2004@gmail.com"; // Replace with your actual email address or a valid domain email

    // Send the email
    if (mail($email, $subject, $message, "From: $from")) {
        echo "Notification sent successfully!";
    } else {
        echo "Failed to send notification. Please try again later.";
    }
}
?>
