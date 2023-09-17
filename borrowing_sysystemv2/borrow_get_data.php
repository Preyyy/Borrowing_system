<?php // Check if a date filter is set
            $dateFilter = isset($_GET['dateFilter']) ? mysqli_real_escape_string($conn, $_GET['dateFilter']) : '';

            // Number of rows to display per page
            $rowsPerPage = 10;

            // Determine the current page number
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $currentPage = intval($_GET['page']);
            } else {
                $currentPage = 1;
            }

            // Calculate the offset for the SQL query
            $offset = ($currentPage - 1) * $rowsPerPage;

            // Query to retrieve data from the borrowers table with pagination and date filter
            $query = "SELECT * FROM items_borrowed";

            // If a date filter is selected, add it to the query
            if (!empty($dateFilter)) {
                $query .= " WHERE date_borrowed = '$dateFilter'";
            }

            $query .= " LIMIT $offset, $rowsPerPage";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<tr><th>Borrower's Name</th><th>Item</th><th>Department</th><th>Item Description</th><th>Date Borrowed</th><th>Date Returned</th><th>Edit</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";

                    echo "<td>" . $row['borrower_name'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['item_description'] . "</td>";
                    echo "<td>" . $row['date_borrowed'] . "</td>";

                    if ($row['date_returned'] == '0000-00-00') {
                        echo "<td>Unreturned</td>";
                    } else {
                        echo "<td>" . $row['date_returned'] . "</td>";
                    }

                    echo "<td><a class=\"btn btn-outline-dark  me-2\" href='edit_item.php?id=" . $row['itemId'] . "'>Update</a></td>"; // Add the Edit button here

                    echo "</tr>";
                }

            }
            