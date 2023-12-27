<?php
session_start();
$name = $_SESSION["name"];

 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ AWS | Result</title>
   
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen ">
<div class=" absolte  w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
  <div class="bg-blue-600 h-2.5 rounded-full" style="width: 85%"></div>

    <div class="flex items-center justify-center m-44">
    <div class="max-w-xl h-64 bg-white p-8 rounded-md shadow-md w-full ">

       
        <?php
        $result = $_SESSION["result"];
        $message = "";
        $percentage = $result * 10;

        if ($result < 5) {
          
            $message = "Good Luck For Next Time $name .  Your result is ";
        } elseif ($result >= 5 && $result < 7 ) {
            $message = "Nice job $name Keep Going! try again to success  Your result is ";
        } else {
            $message = "Good job $name! You past your Quiz with success Your result is ";
        }
        ?>

        <div class="text-center">
            <h1 class="text-4xl font-semibold mb-4"><?php echo $message; ?> <span class="text-blue-600 "><?php echo $percentage; ?>%</span> </h1>
        </div>
       
        <button  class=" mt-8 text-blue-600 p-3 border border-blue-600  rounded-xl hover:bg-blue-700 hover:text-white duration-300 ease-in-out mb-4 "> <a href="../views/correction.php">View Corrections</a></button>

    </div>
</div>

</body>
</html>
