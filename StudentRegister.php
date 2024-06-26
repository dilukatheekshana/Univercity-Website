<?php
include_once("db-config.php");

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $nic = $mysqli->real_escape_string($_POST["nic"]);
    $name = $mysqli->real_escape_string($_POST["name"]);
    $address = $mysqli->real_escape_string($_POST["address"]);
    $tel = $mysqli->real_escape_string($_POST["tel"]);
    
    // Get the selected course name from the POST data
    $courseCode = $mysqli->real_escape_string($_POST["category"]);
    $courseName = "";

    // Map the course code to the corresponding course name
    switch ($courseCode) {
        case "se":
            $courseName = "Software Engineering";
            break;
        case "bm":
            $courseName = "Business Management";
            break;
        case "en":
            $courseName = "English";
            break;
        // Add more cases if needed for other courses
    }

    // Insert data into the database
    $sql = "INSERT INTO students (nic, name, address, tel, course) VALUES ('$nic', '$name', '$address', '$tel', '$courseName')";

    if ($mysqli->query($sql) === TRUE) {
        // JavaScript script to show the dialog box
        echo '<script>
                alert("Student registered successfully");
                window.location.href = "StudentRegister.html";
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
