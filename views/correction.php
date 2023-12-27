<?php
session_start();
$_SESSION['incorrect'];

include_once("../model/questions.php");

$dbconn = new Database();
$question_class = new questionDAO($dbconn->pdo);

// Retrieve explanations for incorrect questions
$incorrectQuestionIds = $_SESSION["incorrectQuestion"];
$explanations = array();

foreach ($incorrectQuestionIds as $questionId) {
    $explanationData = $question_class->getExplanation($questionId);
    $explanations[] = $explanationData;
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
    <div class="flex flex-col items-center justify-center ">
        <h2 class="text-3xl text-blue-600 mb-8 font-semibold mt-8">Explanations for Incorrect Questions:</h2>
        <?php foreach ($explanations as $explanationData): ?>
            <div class="bg-white shadow-2xl transform  hover:scale-110 transition-transform duration-300 hover:shadow-blue-700 p-14 mt-7 rounded-lg  mb-8 flex flex-col gap-3 w-full max-w-3xl">
                <p class="font-medium italic text-center text-2xl mb-4"><span class="text-blue-600 font-bold"> Question: </span><?php echo $explanationData['question_text']; ?></p>
                <h1 class="text-xl font-bold text-center text-blue-600 mb-2">Correct Answer Is: <span class="font-semibold text-xl text-black"><?php echo $explanationData['answer_text']; ?></span></h1>
                <p class="font-mono text-center text-xl"><span class="text-blue-600 font-bold">Justification: </span><?php echo $explanationData['explanation']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
