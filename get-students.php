<?php
  session_start();

  // Database connection using $conn as mysqli obj
  require "db-details.php";
    
  $sql = "select
  s.id as id,
  s.f_name as fname,
  s.l_name as lname,
  s.sex,
  sch.name as school,
  p.name as program,
  c.name as country  
From
  student s
join
  program p ON s.program = p.id
join
  school sch ON p.school = sch.id
join
  country c on s.country = c.id
";

$result = $conn->query($sql);
if ($result){
    echo "<script>\n";
    echo "const studentList = {\n";
    while($row = $result->fetch_assoc()) {
        echo sprintf("    %d: {name: %s, sex: %s, school: %s, program: %s, country: %s},\n",
            $row['id'],
            json_encode($row['f_name'] ." ". $row['l_name']),
            json_encode($row['sex']),
            json_encode($row['program']),
            json_encode($row['school']),
            json_encode($row['country'])
        );
    }
    echo "};\n";
    echo "alert (studentList[0].name);"
    echo "</script>\n";

}

    
