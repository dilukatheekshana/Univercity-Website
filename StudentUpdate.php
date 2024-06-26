<?php
include_once("db-config.php");

// Variables to store update status and NIC
$updateStatus = "";
$nic = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if NIC is set in the POST request
    if (isset($_POST["nic"])) {
        // Collect and sanitize form data
        $nic = $mysqli->real_escape_string($_POST["nic"]);

        // Check if the student exists
        $checkSql = "SELECT * FROM students WHERE nic = '$nic'";
        $result = $mysqli->query($checkSql);

        if ($result->num_rows > 0) {
            // Student exists, update the details
            $name = $mysqli->real_escape_string($_POST["name"]);
            $address = $mysqli->real_escape_string($_POST["address"]);
            $tel = $mysqli->real_escape_string($_POST["tel"]);
            $course = $mysqli->real_escape_string($_POST["category"]);

            $updateSql = "UPDATE students SET name='$name', address='$address', tel='$tel', course='$course' WHERE nic='$nic'";

            if ($mysqli->query($updateSql) === TRUE) {
                $updateStatus = "Student details updated successfully! ";
            } else {
                $updateStatus = "Error updating student details: " . $mysqli->error;
            }
        } else {
            $updateStatus = "No matching student found for the given NIC.";
        }
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome & Login</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <p><?php echo $updateStatus; ?></p>
    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
