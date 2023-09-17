<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login_form.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrowing Form</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function input_cleaner($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    </script>
    <style>
    </style>
</head>
<body style="background-color: #212528;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../it">IT CHEATSHEET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/borrowing_sysystemv1">Borrowing Form</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="borrow_view.php">Borrowed</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5 d-flex justify-content-center">
    <div class="card" style="width: 50rem;">
        <div class="card-header text-center">
            <h1>BORROWING FORM</h1>
        </div>
        <div class="card-body mt-3">
            <form action="insert.php" method="post" class="insert-form">
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <select id="borrower_name" name="borrower_name" required class="form-select" aria-label=".form-select-sm example">
                                <option value="">Select or Type...</option>
                                <?php
                                // Include your database connection code here
                                $conn = mysqli_connect("localhost", "root", "", "borrow_items");

                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $query = "SELECT employees FROM ace_employees";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $employees = $row['employees'];
                                    echo "<option value='$employees'>$employees</option>";
                                }
                                mysqli_close($conn); // Close the database connection
                                ?>
                            </select>
                            <label for="borrower_name">Borrower's Name</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select id="item_type" name="item_type" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option value="">Select Department</option>
                                <?php
                                // Include your database connection code here
                                $conn = mysqli_connect("localhost", "root", "", "borrow_items");

                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $query = "SELECT department FROM dept_lists";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $department = $row['department'];
                                    echo "<option value='$department'>$department</option>";
                                }
                                mysqli_close($conn); // Close the database connection
                                ?>
                            </select>
                            <label for="item_type">Department</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="item_desc" placeholder="Item Description" name="item_name" required>
                    <label for="item_desc">Item Lending</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea id="item_description" name="item_description" required style="height: 100px" placeholder="Leave a comment here" class="form-control"></textarea>
                    <label for="item_description">Comments</label>
                </div>
        </div>
        <div class="card-footer">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" name="ok_button_clicjed" value="Submit" class="btn btn-outline-dark me-2">
            </div>
        </div>
    </form>
</div>
</div>
</body>
</html>
