<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "It got here";
    // Sanitize and validate inputs
    $name = filter_var($_POST["booking_name"], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST["booking_email"], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["booking_phone"], FILTER_SANITIZE_SPECIAL_CHARS);
    // $date = filter_var($_POST["booking_date"], FILTER_SANITIZE_SPECIAL_CHARS);
    $department = filter_var($_POST["depertment_post"], FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || $department == "select-option") {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Send the email
    $to = "enquiry@hayatcareservices.co.uk";
    $subject = "New Booking Enquiry";
    $message = "Name: $name\nEmail: $email\nPhone: $phone\nDate: $date\nDepartment: $department";

    // Send the email
    $headers = "From: $email\r\n";
    if (mail($to, $subject, $message, $headers)) {
        $_SESSION['notification'] = "Email sent successfully.";
    } else {
        $_SESSION['notification'] = "Error sending email.";
    }

    header("Location: index.php");
} else {
    echo "Invalid request.";
}

