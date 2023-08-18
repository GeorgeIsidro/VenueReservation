<?php
// Start a session to store authentication status
session_start();

// Hardcoded password (replace 'your_password_here' with your actual password)
$correctPassword = 'sibbaluca8';

// Check if the password form has been submitted
if (isset($_POST['password'])) {
    $enteredPassword = $_POST['password'];

    // Check if the entered password matches the hardcoded password
    if ($enteredPassword === $correctPassword) {
        // Password is correct, set authenticated session variable
        $_SESSION['authenticated'] = true;

        // Redirect to the page that was originally requested
        if (isset($_SESSION['requested_page'])) {
            header('Location: ' . $_SESSION['requested_page']);
            exit();
        }
    } else {
        // Password is incorrect, show an error message or perform any other action
        echo 'Invalid password. Please try again.';
    }
}
?>
