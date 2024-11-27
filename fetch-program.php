<?php
    session_start();

    // Database connection using $conn as mysqli obj
    require "db-details.php";

    //Get the data submitted
    $data = json_decode(file_get_contents('php://input'), true);
    //get the school id
    $id = $data['ID'];
    // Query to fetch data
    $sql = "select
        id, name
        from program where school=".$id;

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
