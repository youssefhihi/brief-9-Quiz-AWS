<?php
session_start();
$_SESSION['incorrect'];

include_once("../model/questions.php");
include("../model/answer.php");
$dbconn = new Database();
$question_class = new questionDAO($dbconn->pdo);
$answer_class = new answerDAO($dbconn->pdo);

// Retrieve explanations for incorrect questions
$incorrectQuestionIds = $_SESSION["incorrectQuestion"];
$incorrectAnswerIds = $_SESSION["incorrectAnswer"];
$explanations = array();
$incAnswers = array();

foreach ($incorrectQuestionIds as $key => $questionId) {
    $explanationData = $question_class->getExplanation($questionId);
    $explanations[$key] = $explanationData;
}

foreach ($incorrectAnswerIds as $key => $answerId) {
    $questionId = $incorrectQuestionIds[$key];
    $answerinc = $answer_class->getAnswerInc($answerId, $questionId);
    $incAnswers[$key] = $answerinc;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Quiz</title>
</head>
<body class="bg-gray-100">
<div class="absolute w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
  <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
    <div class="flex flex-col items-center justify-center">
        <h2 class="text-3xl text-blue-600 mb-8 font-semibold mt-8">Explanations for Incorrect Questions:</h2>
        <?php foreach ($explanations as $key => $explanationData): ?>
            <div class="bg-white shadow-2xl transform hover:scale-110 transition-transform duration-300 hover:shadow-blue-700 p-14 mt-7 rounded-lg mb-8 flex flex-col gap-3 w-full max-w-3xl">
                <p class="font-medium italic text-center text-2xl mb-4"><span class="text-blue-600 font-bold"> Question: </span><?php echo $explanationData['question_text']; ?></p>
                <?php $answerinc = $incAnswers[$key]; ?>
                <h1 class="text-xl font-bold text-center text-red-600 mb-2">Your Incorrect Answer Is: <span class="font-semibold text-xl text-black"><?php echo $answerinc['answer_text']; ?></span></h1>
                <h1 class="text-xl font-bold text-center text-blue-600 mb-2">Correct Answer Is: <span class="font-semibold text-xl text-black"><?php echo $explanationData['answer_text']; ?></span></h1>
                <p class="font-mono text-center text-xl"><span class="text-blue-600 font-bold">Justification: </span><?php echo $explanationData['explanation']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
