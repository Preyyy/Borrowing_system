<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 </head>

<body >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../it">IT CHEATSHEET</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/borrowing_sysystemv2">Borrowing Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="borrow_view.php">Borrowed</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="card mt-5" >

            <div class="card-header mb-3 d-flex justify-content-center">
                <form method=" GET" action="borrow_view.php">
               
                <select class="form-select form-select-lg mb-3" aria-label="Large select example" id="dateFilter" name="dateFilter" onchange="this.form.submit()">
                
                    <option value="">Select Date</option>
                    <?php
                    // Include your database connection code here
                    include("db_connection.php");
                    include("borrow_date.php");

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </select>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-light table-hover">
                    <?php
                    // Include your database connection code here
                    include("db_connection.php");
                    include("borrow_get_data.php");

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>






    </div>
</body>

</html>