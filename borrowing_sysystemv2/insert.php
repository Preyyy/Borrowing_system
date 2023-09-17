<?php
$conn = mysqli_connect("localhost", "root", "", "borrow_items");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function isInputEmpty($input) {
    return empty(trim($input));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = input_cleaner($_POST['item_name']);
    $item_description = input_cleaner($_POST['item_description']);
    $item_type = input_cleaner($_POST['item_type']);
    $borrower_name = input_cleaner($_POST['borrower_name']);

    // Check if any input is empty
    if (isInputEmpty($item_name) || isInputEmpty($item_description) || isInputEmpty($item_type) || isInputEmpty($borrower_name)) {
        
            echo "<script>alert('Item fields empty.');window.location='home.php';</script>";
            header("location: home.php");
            exit();
            
        
    } 
    
    else {
        // Get the current date
        $current_date = date("Y-m-d");

        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($conn, "INSERT INTO items_borrowed (item_name, department, item_description, date_borrowed, borrower_name) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $item_name, $item_type, $item_description, $current_date, $borrower_name);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Item inserted successfully.');window.location='home.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);

function input_cleaner($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
