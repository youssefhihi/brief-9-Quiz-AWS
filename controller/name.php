<?php

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    session_start();
   $_SESSION["name"]= $name ;
//    header("location: ../views/play.php");   
        header ("location: ../controller/checkAnswer.php");
  }





