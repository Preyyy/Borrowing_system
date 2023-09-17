session_start(); // Start the session

// Destroy the session data
session_destroy();

// Redirect to the login page
header("Location: login_form.html");
exit();
