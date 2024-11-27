<?php
    session_start();

    // Database connecction
    require "db-details.php";

    // Query to fetch data
    $sql = "select
        content from complaint
        ";

    $result = $conn->query($sql);

    // Prepare the response
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Add each row to the array
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
    // Close connection
    $conn->close();
?>
