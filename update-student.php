<?php
    session_start();

    $f_name = $_POST['first-name'];
    $l_name = $_POST['last-name'];
    $sex = $_POST['sex'];
    $school = $_POST['school'];
    $program = $_POST['program'];
    $country = $_POST['country'];
    
    if($_SESSION['USER_TYPE'] == 'staff' ) {
        $student_id = $_POST['student-id'];
        $sql = "insert into student(id, password, f_name, l_name, sex, program, country)
        values($student_id, '$student_id', '$f_name', '$l_name', '$sex', $program, $country)";
    }else{
        $student_id = $_SESSION['ID'];
        $sql = "update student set
        f_name = '$f_name', l_name = '$l_name',
        sex = '$sex', program = $program,
        country = $country, has_edited = '1'
        where id = $student_id";
    }

    //database connection using $conn as mysqli obj
    require "db-details.php";

    $result = $conn->query($sql);
    if ($result){
        echo "success";
    }else{
        echo "xxxxxxxx";
    }
?>
