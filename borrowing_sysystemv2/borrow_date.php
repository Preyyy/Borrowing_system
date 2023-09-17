<?php
                        // Include your database connection code here
                        include("db_connection.php");
            
                        $dateFilter = isset($_GET['dateFilter']) ? mysqli_real_escape_string($conn, $_GET['dateFilter']) : '';

                        $query = "SELECT DISTINCT date_borrowed FROM items_borrowed";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $date_borrowed = $row['date_borrowed'];
                            $selected = ($dateFilter == $date_borrowed) ? 'selected' : '';
                            echo "<option value='$date_borrowed' $selected>$date_borrowed</option>";
                        }