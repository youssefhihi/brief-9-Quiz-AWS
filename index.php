<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">

    <title>Quiz AWS</title>
</head>

<body class= " bg-gray-200 h-screen p-0 m-0 overflow-hidden">
<div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
  <div class="bg-blue-600 h-2.5 rounded-full" style="width: 32%"></div>
<div class="flex space-x-48">
<div>
    <img class="" src="assets/images/quiztime-1.gif" alt="" style="height: 20vh; ">
</div>
    <div class="h-screen flex flex-col gap-10 items-center justify-center">
        <h1 class="text-center font-serif text-black text-5xl font-bold">Take This Challenge <i class="fas fa-sunglasses"></i>  </h1> 
        

        <div class="h-72  p-10  bg-white mx-auto max-w-xl rounded-2xl">
            <form class=" mb-10  mt-10 ml-10 mr-10  flex flex-col gap-10" method="post" action="controller/name.php">
                <input class="w-80 h-14 rounded-xl border-2 border-blue-500 mx-auto text-center" name="name" type="text" 
                    placeholder="Enter your name" required>
                <input
                    class=" w-36 h-10 mx-auto text-xl text-blue-600 font-semibold border border-blue-600 rounded-xl hover:bg-blue-500 hover:text-white duration-300 ease-in-out"
                    type="submit" name="submit" value="Let's Start">
            </form>
        </div>
    </div>
</div>

</div>

</body>

</html>
