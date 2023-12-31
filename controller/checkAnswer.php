<?php
session_start();

include_once("../config/db.php");
include_once("../model/answer.php");
include_once("../model/questions.php");

$answer_class = new answerDAO($dbconn->pdo);
$question_class = new questionDAO($dbconn->pdo);
$numquestions = $question_class->NumQuestions();


if (!isset($_SESSION['i'])) {
    $_SESSION['i'] = 0;
    $_SESSION['result'] = 0;
    $_SESSION['incorrect'] = 0;
    $_SESSION["incorrectQuestion"] = [];
    $_SESSION["incorrectAnswer"] = [];
    header('Location: ../views/play.php?questionId=' . $_SESSION["i"]);
    exit();
}

 $_SESSION['idQ'] = array();

if (isset($_POST['check'])) {
    $answer = $_POST['selectedAnswer'];
    $questionId = $_POST['id_question'];
    $correctAnswer = $answer_class->correctAnswer($questionId, $answer);
   array_push( $_SESSION['idQ'] , $questionId);
    if ($_SESSION['i'] == ($numquestions - 1)) {
        header("Location: ../views/result.php");
        exit();
    } else {
        if ($correctAnswer) {
            
            $_SESSION['result']++;
        } else {
            $_SESSION['incorrect']++;
            array_push( $_SESSION["incorrectQuestion"], $questionId);
            array_push( $_SESSION["incorrectAnswer"], $answer);
        }
        $_SESSION['i']++;  
  
    
   
        header('Location: ../views/play.php?questionId=' . $_SESSION["i"]);
        exit();
    }
    
}
?>
