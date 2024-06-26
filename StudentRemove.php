<?php
include_once("db-config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if NIC is set in the POST request
    if (isset($_POST["nic"])) {
        // Collect and sanitize form data
        $nic = $mysqli->real_escape_string($_POST["nic"]);

        // Remove the student from the database
        $sql = "DELETE FROM students WHERE nic = '$nic'";
        
        if ($mysqli->query($sql) === TRUE) {
            if ($mysqli->affected_rows > 0) {
                echo "Student removed successfully!";
            } else {
                echo "No matching student found for deletion.";
            }
        } else {
            echo "Error removing student: " . $mysqli->error;
        }
    }
}

// Close the database connection
$mysqli->close();
?>
