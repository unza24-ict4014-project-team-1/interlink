<?php
    session_start();

    // Check if the user is logged in (session)
    $user_id = $_SESSION['ID'];
    
    $userType = $_SESSION['USER_TYPE'];
    $staffID = 1000000000;
    $receiverId;
    $senderId;

    // Retrieve the incoming data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the text message and receiver ID
    $text = $data['text'];

    if ($userType == "student"){
        $senderID = $user_id;
        $receiverID = $staffID;
    }elseif($userType == "staff") {
        $senderID = $staffID;
        $receiverID = $data['id'];
    }
    

    //database connection using $conn as mysqli obj
    require 'db-details.php';

    //set field and value variables
    $insertFields = "sender_type, sender_id, reciever_id, content";
    $insertValues = "'".$userType."',".$senderID.",". $receiverID.",'".$text."'";

    // Prepare and bind
    $query = $conn->prepare("INSERT INTO message ($insertFields) values ($insertValues)");
    
    print_r("INSERT INTO message ($insertFields) values ($insertValues)");

    // Execute the statement
    if($query->execute()){
        echo "success";
    }else{
        echo "error";
    }
?>
