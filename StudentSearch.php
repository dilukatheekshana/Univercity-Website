<?php
include_once("db-config.php");

// Check if NIC is set in the POST request
if (isset($_POST["nic"])) {
    // Collect and sanitize form data
    $nic = $mysqli->real_escape_string($_POST["nic"]);

    // Search for the student in the database
    $sql = "SELECT * FROM students WHERE nic = '$nic'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Display the table with student details
        echo "<table border='1'>
                <tr>
                    <th>NIC</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Telephone Number</th>
                    <th>Course</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nic']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['tel']}</td>
                    <td>{$row['course']}</td>
                </tr>";
        }

        echo "</table>";

        // Back button to return to the search form
        echo "<br><br>";
        echo "<button onclick='goBack()'>Back to Search</button>";
        echo "<script>
                function goBack() {
                    window.history.back();
                }
              </script>";
    } else {
        echo "No matching student found.";
    }

    // Free the result set
    $result->free_result();
}

// Close the database connection
$mysqli->close();
?>
