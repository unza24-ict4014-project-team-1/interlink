<?php
  session_start();

  //database connection using $conn as mysqli obj
  require 'db-details.php';

  // Get user input and sanitize
  $user_id = $_SESSION['ID'];
  $user_password = $_SESSION['PASSWORD'];
  $user_type = $_SESSION['USER_TYPE'];

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
  where s.id = " . $user_id;

  $result = $conn->query($sql);
  if ($result){
    while($row = $result->fetch_assoc()){
      $name = $row['fname'] . " " . $row['lname'];
      $sex = $row['sex'];
      $school = $row['school'];
      $program = $row['program'];
      $country = $row['country'];
      $id = $row['id'];
    }
  }
?>


<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>STUDENT DASHBOARD  </title>

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
              <button onclick="studentInfo()" class="nav-link d-flex align-items-center gap-2 active" aria-current="page">
              <img class="sidebar-icon" src="icons/details.svg"/>
                Details
              </button>
            </li>
            <li class="nav-item">
              <button  onclick="message()" class="nav-link d-flex align-items-center gap-2 active" aria-current="page">
              <img class="sidebar-icon" src="icons/message.svg"/>
                Message Staff
              </button>
            </li>
            <li class="nav-item">
            <button onclick="complaint()" class="nav-link d-flex align-items-center gap-2 active" aria-current="page">
                <img class="sidebar-icon" src="icons/complaint.svg"/>
                Lodge Complaint
              </button>
            </li>
            <li class="nav-item">
            <a href="https://moodle.unza.zm" class="nav-link d-flex align-items-center gap-2">
              <img class="sidebar-icon" src="icons/elearning.svg"/>
                E-larning
              </a>
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
      <h2 id="current-display">Student Information</h2>
      <!--Table for student info display-->
      <div id="student-detail-sub" class="dashboard-sub">
        <table id="student-detail-view" class="student-table">
          <thead>
            <tr>
                <th style="width: 150px;"></th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>Id</td>
                <td data-label="Id"><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td data-label="Name"><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Sex</td>
                <td data-label="Sex"><?php echo $sex; ?></td>
            </tr>
            <tr>
                <td>School</td>
                <td data-label="School"><?php echo $school; ?></td>
            </tr>
            <tr>
                <td>Program</td>
                <td data-label="Program"><?php echo $program; ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td data-label="Country"><?php echo $country; ?></td>
            </tr>
          </tbody>
        </table>

<?php
  //connection to DB NEEDS TO BE MADE IN A PRECEDING CODE
  $result = $conn->query("SELECT has_edited FROM student WHERE  id = $user_id AND password = $user_password");
  if($result){
    $result = $result->fetch_assoc();
    if ($result['has_edited'] == '0'){
      echo "<div id='verify-details-display'> <button id='verify-btn'>Open / Close Edit</button>";
      
      //load php file for student form
      require "student-update-form.php";
      echo "</div>
        <script>
        document.getElementById('verify-btn').onclick = function(){
            document.getElementById('student-detail-view').classList.toggle('hidden');
            document.getElementById('verification-form').classList.toggle('hidden');
        }
      </script>";
    }
  }
  ?>
  <!--END OF STUDENT DETAILS DISPLAY-->
  </div>

    <!-- messages SUBSECTION, innitially hidden -->
    <div id="messaging-sub" class="dashboard-sub" style="display: none;">
        <div class="messages" id="messages"></div>
        <div class="input-container">
            <input type="text" placeholder="Type your message..." class="message-input" id="messageInput">
            <button class="send-button" id="sendButton" style="font-size: 150%;">SEND</button>
        </div>
    </div>

    <!-- COMPLAINT SUBSECTION, INNITIALY HIDDEN-->
    <div id="complaint-sub" class="dashboard-sub hidden">
      <form id="complaint-form">
        <textarea id="complaint-text" name="complaint" placeholder="Enter Your Text here: this text is sent without your personal details only you will know You sent it" style="width: 50vw; height: 50vh;"></textarea><br/>
        <button type="submit" id="complaint-btn">Submit Complaint</button>
      </form>
    </div>
    <script>
      document.getElementById('complaint-form').onsubmit = (event) => {
        event.preventDefault();
        const content = document.getElementById("complaint-text").value.trim();
        const obj = { method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ text: content})
        }
        try{
          fetch("submit-complaint.php", obj)
          .then(response => response.text())
          .then(data => {
            if(data.includes("success")){
              document.getElementById('complaint-sub').innerHTML = "<h3>\
              SUCCESS</h3>"
            }
          });
        } catch (error) {
          alert('Error sending message: check connection');
        }
      };
     </script>
  
  </main>
 </div>
</div>

<?php
    //define the message_id javascript variable
    //used to position chat messages either left or right
    require 'message-id.php';
?>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
<script src="js/student-dashboard.js"></script>
<script src="js/sssdashboard.js"></script>
<script src="js/messaging.js"></script>
</body>
</html>
