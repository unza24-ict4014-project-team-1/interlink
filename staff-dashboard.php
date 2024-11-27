<?php
  session_start();

  //database connection using $conn as mysqli obj
  require 'db-details.php';

  // Get user input and sanitize
  $user_id = $_SESSION['ID'];
  $user_password = $_SESSION['PASSWORD'];
  $user_type = $_SESSION['USER_TYPE'];

  $sql = "select id, f_name, l_name
  FROM staff where id = " . $user_id;

  $result = $conn->query($sql);
  if ($result){
    while($row = $result->fetch_assoc()){
      $name = $row['f_name'] . " " . $row['l_name'];
      $id = $row['id'];
    }
  }
?>  
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="js/color-modes.js"></script>
 <?php
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
  $studentList = array();
  while($row = $result->fetch_assoc()) {
    $studentList[$row['id']] = [
      'name' => $row['fname'] . ' '. $row['lname'],
      'sex'=> $row['sex'],
      'program'=> $row['program'],
      'school'=> $row['school'],
      'country'=> $row['country']
    ];
  }
  echo "<script>
    const studentList = ". json_encode($studentList);
  echo "\n</script>";
}
  
?>
  

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>STAFF DASHBOARD  </title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/info-table.css">
    <link rel="stylesheet" href="css/messages.css">
    <link rel="stylesheet" href="css/update-student-form.css">

    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <style>
      .sidebar-icon{
        width: 30px;
      }
      #sidebar{
        position: sticky !important;
      }   
      #current-display{
        color: blue;
        font-size: 300%;
      }
      
    </style>
  </head>
  <body>
    <script src="js/student-dashboard-header.js"></script>
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Welcome <?php echo $name; ?></a>

  <ul class="navbar-nav flex-row d-md-none">
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
        <svg class="bi"><use xlink:href="#search"/></svg>
      </button>
    </li>
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="bi"><use xlink:href="#list"/></svg>
      </button>
    </li>
  </ul>

  <div id="navbarSearch" class="navbar-search w-100 collapse">
    <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <div id="sidebar" class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <button  onclick="message()" class="nav-link d-flex align-items-center gap-2 active" aria-current="page">
              <img class="sidebar-icon" src="icons/message.svg"/>
                Message Students
              </button>
            </li>
            <li class="nav-item">
            <button onclick="viewComplaint()" class="nav-link d-flex align-items-center gap-2 active" aria-current="page">
                <img class="sidebar-icon" src="icons/complaint.svg"/>
                View Complaint
              </button>
            </li>
            <li class="nav-item">
            <button onclick="addStudent()" class="nav-link d-flex align-items-center gap-2">
              <img class="sidebar-icon" src="icons/elearning.svg"/>
                Add student
             </buttom>
            </li>
          </ul>

          <hr class="my-3"/>
          
          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
            <a href="logout.php" class="nav-link d-flex align-items-center gap-2 active" aria-current="page" onclick="message()">
              <img class="sidebar-icon" src="icons/logout.svg"/>
                Sign out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!-- this header changes based on mode student is in, i.e. messaging etc -->
      <h2 id="current-display">SELECT STUDENT TO MESSAGE</h2>


    
        <?php
            //define the message_id and user_type javascript variable
            //used to position chat messages either left or right
            require 'message-id.php';
        ?>

  <div id="student-list-sub" class="dashboard-sub">
      <?php
        foreach($studentList as $id => $details){
          echo "<button class='select-student-btn' onclick='chooseStudent(".$id.")'>".$id."<br/>".$details['name']."</botton> ";
        }
        ?>

    </div>

    <!-- Add students -->
    <div id="add-student-sub" class="dashboard-sub" style="display: none;">
       <?php
          //require student form
          require "student-update-form.php";
       ?>
    </div>

    <!-- view complaints -->
    <div id="complaint-sub" class="dashboard-sub" style="display: none;">
       
    </div>
    

    
    <!-- messages SUBSECTION, innitially hidden -->
    <div id="messaging-sub" class="dashboard-sub" style="display: none;">
        <div class="messages" id="messages"></div>
        <div class="input-container">
            <input type="text" placeholder="Type your message..." class="message-input" id="messageInput">
            <button class="send-button" id="sendButton" style="font-size: 150%;">SEND</button>
        </div>
    </div>
  </main>
 </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
<script src="js/staff-dashboard.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/messaging.js"></script>
</body>
</html>
