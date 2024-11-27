<?php
    session_start();
    
    // Get user input
    $user_id = $_POST['username'];
    $user_type = $_POST['user-type'];
    $user_password = $_POST['password'];

    // Create connection using $conn as mysqli obj
    require 'db-details.php';

    // Prepare and bind
    $query = $conn->prepare("SELECT * FROM " . $user_type . " WHERE  id = ? AND password = ?");
    $query->bind_param("is", $user_id, $user_password);

    // Execute the statement
    $query->execute();

    // Get the result
    $result = $query->get_result();

    if ($result->num_rows == 0) {
        session_abort();
        echo "failed";
    }else{
        $_SESSION['ID'] = $user_id;
        $_SESSION['USER_TYPE'] = $user_type;
        $_SESSION['PASSWORD'] = $user_password;
        echo "success";
    }
?>
