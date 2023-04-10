<style>
h5.view_mode{
    font-weight:bold;
}
</style>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
error_reporting(0);
// If start date and end date have been posted
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    // Sanitize user inputs to prevent SQL injection
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    // Prepare SQL statement
    $sql = "SELECT * FROM sales_entry WHERE date BETWEEN '$start_date' AND '$end_date'";

    // Execute SQL statement and retrieve results
    $result = $conn->query($sql);

    // Check for errors and loop through results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output results here
            echo "ID: " . $row['id'] . " - Name: " . $row['name'] . "<br>";
        }
    } else {
        echo "No results found.";
    }
}

// Close database connection
//$conn->close();
?>
