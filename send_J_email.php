<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Get the email from the form

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Send the email
    $to = "contact@wiseworldstore.com"; // Replace with your email address
    $subject = "Email from Livepure site Submission";
    $message = "Email: " . $email;

    if (mail($to, $subject, $message)) {
        header("location:index.php?email=success");
    } else {
        echo "Failed to send email";
    }
}
?>