<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "borrow_items");


session_start();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database for the user
$sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    // Redirect to the home page on successful login
    $_SESSION['username'] = $username;
    mysqli_close($conn);
    header("Location: home.php");
    exit();
} else {
    echo "<script>alert('Login failed. Invalid username or password!'); window.location='login_form.html';</script>";
 
}

// Close the database connection
mysqli_close($conn);
?>