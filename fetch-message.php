<?php
    session_start();

    // Database connection using $conn as mysqli obj
    require "db-details.php";

    $userId = $_SESSION['ID'];    
    $userType = $_SESSION['USER_TYPE'];

    $searchId;
    
    if ($userType == 'student'){
        $searchId = $userId;
    }elseif($userType == 'staff'){
        $data = json_decode(file_get_contents('php://input'), true);
        $searchId = $data['id'];
    }

    // Query to fetch data
    $sql = "select
        m.reciever_id, m.sender_id, s.f_name, s.l_name, m.content, m.timestamp
        from message as m
        join student as s
        on m.sender_id = s.id
        or m.reciever_id = s.id
        WHERE (m.reciever_id = $searchId or m.sender_id = $searchId)";

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
