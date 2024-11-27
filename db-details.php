<?php
   //READ THOROUGH AND COMMENT/UNCOMMENT LINES ACCORDINGLY
   //CHECK THE HEADING DISCRIPTION FOR NON EMPTY SEQUENCED LINES

   /*// DETAILS FOR INFINITY FREE
   $dbHost = "sql308.infinityfree.com";
   $dbUser = "if0_37541813";
   $dbName = "if0_37541813_interlink";
   $dbPass = "interlink0unza";
   mysqli($dbHost, $dbUser, $dbPass, $dbName);
   */
   
   // DETAILS FOR XAMPP OR TREMUX
   $dbHost = "localhost";
   $dbUser = "root";
   $dbName = "interlink";
   $dbPass = "";

   //ADDITIONAL DETAILS FOR TERMUX
   $dbPort = 3306;
   $dbSocket =  "/data/data/com.termux/files/usr/var/run/mysqld.sock";
   
   
   /*// CONNECTION FOR XAMPP AND INFINITYFREE
   $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
   */

   // CONMECTION FOR TERMUX
   $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort, $dbSocket);


   if($conn->connect_error){
   	  die("connection failed: " . $conn->connect_error . "\n" );
   }
?>
