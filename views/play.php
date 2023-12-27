<?php
session_start();
$name = $_SESSION["name"];

if (empty($name)) {
    header("location: ../index.php ");
}
include("../model/questions.php");
include("../model/answer.php");
$dbconn = new Database();
$question_class = new questionDAO($dbconn->pdo);
$answer_class = new answerDAO($dbconn->pdo);
$questions = $question_class->getQuestion();
$numquestions = $question_class->NumQuestions();







?>


<!DOCTYPE html>
<html lang="en">

<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>QUIZ GAME AWS</title>
</head>
<body>
<div id="questionContainer"></div>
    <div class="flex flex-col gap-28 pt-20">
    <div id= "text" style="display: block" class=""><h1 class="text-4xl  font-serif font-semibold text-center"> <?= $name;?> Are You Ready !! </h1></div>
    <div id="countdown" class=" mx-auto text-9xl font-extralight text-center "></div>
    </div> 
	
	<?php
	if (isset($_GET['questionId'])) {
		$question = $questions[$_GET['questionId']];
        $theme = $question_class->gettheme($question->getQuestionId());
		?>
            <section id="questionContent" style="display: none;" > 
                <form method="post" action="../controller/checkAnswer.php" >
                    <div class="absolute top-10 pl-10 pr-20  flex justify-between w-full">
                        <h1 class="  font-mono font-semibold "> Theme of Question is <span class="text-center text-blue-800"><?php echo $theme ; ?></span></h1>
                        <h1 class=" p-1 pr-3 pl-3 text-xl  text-white rounded-2xl bg-black"> <?php echo $_SESSION['i']+1; ?> / <?php echo $numquestions; ?></h1>
                    </div>
        <div id="questionText" class="flex flex-col gap-14">
		<input id="IdQuestion" type="hidden" name= "id_question" value="<?= $question->getQuestionId(); ?>">
		<h1 class=" font-medium text-4xl text-center "> Question : <span class="font-mono text-blue-600"><?= $question->getQuestionId(); ?></span></h1>
		<p class=" mb-10 font-medium italic text-center text-2xl "><?= $question->getQuestionText(); ?></p>
		</div>
		<div class= "mx-auto max-w-2xl grid grid-cols-2  gap-16 text-center ">
		<?php
		$answers = $answer_class->getAnswer($question->getQuestionId()); 
     
		foreach ($answers as $answer) {
			
			?>
                            <div  class="flex items-center  space-x-2">
                                
                               
                                <input type="radio" class="answer-radio transform scale-150" name="selectedAnswer" value="<?= $answer->getAnswerId() ?>">
                                <label for="answer" class="w-96 h-14 rounded-xl border text-blue-700 border-blue-600 hover:text-white hover:bg-blue-800 duration-200 ease-in-out">
                                    <?= $answer->getAnswer();?>
                                </label>
                            </div>
                        
                    <?php
                        }
                    ?>
                  </div>
                        
                  <div id="next" class=" mt-10 pl-96" style="display: none;">
                    <input class=" ml-40 rounded-xl border w-48 h-10 border-black  hover:bg-white hover:text-black 
                    bg-black text-white"
                     type="submit" name="check" value="Next Question">
                    </div>
                </form >
                <?php
                
	}
  
	?>
                            
       
          

    </section>
    
</body>
<!-- <script>
    
const questionContainers = document.querySelectorAll('.question-container');
let currentIndex = 0;

function showNextQuestion() {
    questionContainers[currentIndex].style.display = 'none';
    currentIndex = (currentIndex + 1) % questionContainers.length;
    questionContainers[currentIndex].style.display = 'block';

    // Show/hide the "Next Question" button
    document.getElementById('next').style.display = currentIndex === questionContainers.length - 1 ? 'none' : 'block';
}

document.addEventListener('DOMContentLoaded', function () {
    loadQuestion(); // Load the initial question

    // Add an event listener for the form submission
    document.getElementById('quizForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
        submitAnswer();
    });
});

function loadQuestion() {
    // Use AJAX to fetch the next question
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('questionContainer').innerHTML = response.questionHtml;
            } else {
                console.error('Error loading question');
            }
        }
    };
    xhr.open('GET', '../views/play.php'); // Update the URL accordingly
    xhr.send();
}

function submitAnswer() {
    // Use AJAX to submit the answer
    var formData = new FormData(document.getElementById('quizForm'));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                // Process the answer submission response if needed
                console.log(response.message);
            } else {
                console.error('Error submitting answer');
            }
            // Load the next question after submitting the answer
            loadQuestion();
        }
    };
    xhr.open('POST', '../controller/checkAnswer.php'); // Update the URL accordingly
    xhr.send(formData);
}






</script> -->

    <script src="../assets/js/play.js"></script>

</html>
