<?php
// Include your database connection code here
$conn = mysqli_connect("localhost", "root", "", "borrow_items");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'id' query parameter is set
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $itemId = intval($_GET['id']);

    // Retrieve the item details from the database
    $query = "SELECT * FROM items_borrowed WHERE itemId = $itemId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);

        // Handle form submission for editing
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newBorrowerName = mysqli_real_escape_string($conn, $_POST['newBorrowerName']);
            $newItemName = mysqli_real_escape_string($conn, $_POST['newItemName']);
            $newDepartment = mysqli_real_escape_string($conn, $_POST['newDepartment']);
            $newItemDescription = mysqli_real_escape_string($conn, $_POST['newItemDescription']);
            $newDateReturned = mysqli_real_escape_string($conn, $_POST['newDateReturned']);

            // Update the item information in the database
            $updateQuery = "UPDATE items_borrowed SET borrower_name = '$newBorrowerName', item_name = '$newItemName', department = '$newDepartment', item_description = '$newItemDescription', date_returned = '$newDateReturned' WHERE itemId = $itemId";

            if (mysqli_query($conn, $updateQuery)) {
               
                echo "<script>alert('Item information updated successfully.'); window.location='borrow_view.php';</script>";
               
            } else {
                echo "Error updating item information: " . mysqli_error($conn);
            }
        }
?>
<link rel="stylesheet" type="text/css" href="style.css">


<form method="POST" action="">
    <label for="newBorrowerName">Borrower's Name:</label>
    <input type="text" id="newBorrowerName" name="newBorrowerName" value="<?php echo $item['borrower_name']; ?>" required><br>

    <label for="newItemName">Item Name:</label>
    <input type="text" id="newItemName" name="newItemName" value="<?php echo $item['item_name']; ?>" required><br>

    <label for="newDepartment">Department:</label>
    <input type="text" id="newDepartment" name="newDepartment" value="<?php echo $item['department']; ?>" required><br>

    <label for="newItemDescription">Item Description:</label>
    <input type="text" id="newItemDescription" name="newItemDescription" value="<?php echo $item['item_description']; ?>" required><br>

    <label for="newDateReturned">Date Returned:</label>
    <input type="date" id="newDateReturned" name="newDateReturned" value="<?php echo $item['date_returned']; ?>"><br>

    <input type="submit" value="Update" >
    
</form>

<?php
    } else {
        echo "Item not found.";
    }
} else {
    echo "Invalid item ID.";
}

mysqli_close($conn); // Close the database connection
?>
