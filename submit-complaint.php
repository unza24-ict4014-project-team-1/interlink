<?php
    session_start();

    // Retrieve the incoming data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the text message and receiver ID
    $text = $data['text'];
    
    //database connection using $conn as mysqli obj
    require 'db-details.php';

    //set field and value variables
    $insertFields = "content";
    $insertValues = "'".$text."'";

    // Prepare and bind
    $query = $conn->prepare("INSERT INTO complaint ($insertFields) values ($insertValues)");
    
    print_r("INSERT INTO message ($insertFields) values ($insertValues)");

    // Execute the statement
    if($query->execute()){
        echo "success";
    }else{
        echo "error";
    }
?>
