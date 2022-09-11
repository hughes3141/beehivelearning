<?php


// Initialize the session
session_start();

$_SESSION['this_url'] = $_SERVER['REQUEST_URI'];


if (!isset($_SESSION['userid'])) {
  
  header("location: /login.php");
  
}


//Define server path:
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/../secrets/secrets.php";
include($path);


//print_r($_SESSION);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$userId = $_SESSION['userid'];


date_default_timezone_set("Europe/London");
$t = time();


function lastResponse($questionId) {

  global $conn;
  global $t;  
  global $userId;
   

  $sql = "SELECT * FROM flashcard_responses WHERE userId = ? AND questionId = ? ORDER BY timeSubmit DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $userId, $questionId);
  $stmt->execute();
  $result = $stmt->get_result();

  $row =$result->fetch_assoc();
  if($row) {
    //print_r($row);
    return $lastResponse = $row;

  }
  else {
    //echo "<br>This question has not been attempted yet";
    return $lastResponse = array("cardCategory"=>"0", "timeSubmit"=>date("Y-m-d H:i:s", $t));
   
  }

  //echo "<br>";
  //print_r($lastResponse);
  

  /*

  if($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      
      echo "<br>";
      print_r($row);
      
    }
  }
  else {
    echo "<br>This question has not been attempted yet";
  }
  */
}

function timeBetween($dateTime) {

  global $t;
  $now = new DateTime(date("Y-m-d H:i:s", $t));
  $last = new DateTime($dateTime);
  $interval = $now->diff($last);
  $daysSince = $interval->days;
  return $minutesSince = $interval->i;

  //echo "daysSince:".$daysSince." minutesSince:".$minutesSince;
  
  //echo "<br>".$interval->days;
  //echo "<br>difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ".$interval->h." hours ".$interval->i." minutes ".$interval->s." seconds";

}



//echo "<br>Post:";
//print_r($_POST);


//Insert response into database
$stmt = $conn->prepare("INSERT INTO flashcard_responses (questionId,  userId, gotRight, timeStart, timeSubmit, cardCategory) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiissi", $questionId, $userId, $gotRight, $timeStart, $timeSubmit, $cardCategory);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 

{
  $questionId = $_POST['questionId'];
  $gotRight = $_POST['rightWrong'];
  $timeStart = $_POST['timeStart'];
  

  $timeSubmit = date("Y-m-d H:i:s",$t);
  //echo "<br>".$timeSubmit."<br>";

  

  if($gotRight === "0" || $gotRight === "1") {
    $cardCategory = 0;
  }
  else if ($gotRight = 2) {
    if ($_POST['cardCategory'] === "0") {
      $cardCategory = 1;
    } else if ($_POST['cardCategory'] === "1") {
      $cardCategory = 2;
    } else if ($_POST['cardCategory'] === "2") {
      $cardCategory = 2;
    }
  }
  
  

  


  $stmt->execute();
    
  //echo "New records created successfully";

  
}

// Retreive question record.

$sql = "SELECT * FROM flashcard_responses WHERE userId = ? ORDER BY id ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows>0) {
  while ($row = $result->fetch_assoc()) {
    /*
    echo "<br>";
    print_r($row);
    */
    
  }
}

//echo "<br>";
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
    
    @tailwind base;
    
    @tailwind components;
    

    @layer components {
      button, button[type=button] {
        @apply  py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75;
      }

      a {
        @apply text-pink-600 bg-blue-200;
      }
    }

    @tailwind utilities;
   


  </style>



    <link rel="stylesheet" href="">
    <style>
      #flashcard {
        /*
        border: 1px solid black;
        margin: 5px;
        padding: 10px;
        */
      }
    </style>
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <?php 
    $path = $_SERVER['DOCUMENT_ROOT'];;
    $path = $path."/navbar.php";
    include $path;
    ?>


    <h1 class="hidden">Flashcard Example</h1>

    <?php

    //Find the teacher of the group the student is in
      //Note: this will need to be changed to refledct that multiple teachers may teach a group

      $sql="SELECT * FROM groups WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_SESSION['groupid']);
      $stmt->execute();
      $result = $stmt->get_result();
      $user = $result->fetch_assoc();

      //print_r($user);

      $teachers = $user['teachers'];

      //echo "<br>".$teachers;

      $teachers = json_decode($teachers);

      //echo "<br>";
      //print_r($teachers);

      //This is what needs to be changed: only the first teacher in the array is included.
      $teacher = $teachers[0];

      //echo "<br>".$teacher;




      //Array of questions set by the teacher:

      $questions = array();
      //Select questions made by the teacher
      $sql="SELECT * FROM saq_question_bank_3 WHERE userCreate = ? AND model_answer <> '' /*AND id BETWEEN 550 AND 600*/";
      #just using "AND model_answer <> ''" so we return cards with answers
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $teacher);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result ->num_rows >0) {
        while ($row=$result->fetch_assoc()) {
          //print_r($row);
          
          // Following for testing purposes to isolate to one question, randomly question where id = 613
          //if($row['id']==613) {array_push($questions, $row);}

          //Push each row into the $questions array.

          array_push($questions, $row);


          
        }
      }




      //print_r($questions);
      foreach($questions as $question) {
        $last = lastResponse($question['id']);
        //echo "<br>".$question['id'].": ".$question['question']." || "./*$last['gotRight'].*/" ".$last['timeSubmit']." cardCat:".$last['cardCategory']." timeSince: ".timeBetween($last['timeSubmit']);
        
        
        
      }
      //echo "<br>Total questions: ".count($questions);


      /*
      The below loop does the following:
        -Identifies random question from the $questions array.
        -Check to see candidate's last response to this question.
        -Performs the logic:
          If(The question is eligible to be answered) : Break loop
          Else IF (the question is ineligible) : Remove question from $queseetions

      */

      
      
      while (count($questions)>0) {


      


          $qCount = count($questions);

          

          
          $randomQuestion = rand(0, $qCount-1);
          //echo $qCount."<br>".$randomQuestion;

          if($randomQuestion<0) {
            $randomQuestion = 0;
          }


          //Find the response for the last time this question was answered:

            $randomQuestionId = $questions[$randomQuestion]['id'];

            //echo "<br>".$randomQuestionId;


            $lastResponse = lastResponse($randomQuestionId);



            //Logic to see if question should appear, based on the bin it is in.

            
            //echo $t;
            //echo date("Y-m-d H:i:s", $t);       
            //echo $lastResponse['timeSubmit'];

           

            $daysSince = timeBetween($lastResponse['timeSubmit']);

            if (
              $lastResponse['cardCategory'] == 0 ||
              (($lastResponse['cardCategory'] == 1 )&&($daysSince>=3) ) ||
              (($lastResponse['cardCategory'] == 2 )&&($daysSince>=5) )
            )

            {
              //echo "<br>Valid questions: ".$qCount;
              break;
            }

            else {
              array_splice($questions, $randomQuestion, 1);


            }



        
      }

      if(count($questions) == 0) {
       
        ?>

        <div  class="font-sans border border-black border-solid p-3 m-2">

        <p class="mb-3">Well done! There are no more cards for you to revise.</p>

        </div>


        <?php
        
      } else {
        
        
        

    ?>

    <div id="flashcard" class="font-sans border border-black border-solid p-3 m-2">
    
      <form method="post">
        <h2 class ="text-lg">Question:</h2>
        <input type="hidden" name="questionId" value = "<?=$questions[$randomQuestion]['id']?>">
        <input type="hidden" name="timeStart" value = "<?=date("Y-m-d H:i:s",time())?>">
        <input type="hidden" name="cardCategory" value = "<?=$lastResponse['cardCategory']?>">
        
        <p class="mb-3"><?php echo $questions[$randomQuestion]['question'];?></p>
        <p><?php //print_r(lastResponse($questions[$randomQuestion]['id']));?>
        
        <div id="buttonsDiv" class="flex justify-center">
          <button type = "button" class="grow m-3" onclick="showAnswers();hideButtons();swapButtons()">I don't know</button>
          <button value ="0" name="rightWrong" class="grow m-3 hidden ">I don't know</button>
          <button type = "button" class="grow m-3" onclick="showAnswers();hideButtons()">Show answers</button>
        </div>
        
        <div id ="answerDiv" class="hidden">
          <h2 class ="text-lg">Answer:</h2>
          <p class="mb-3"><?=$questions[$randomQuestion]['model_answer'];?></p>
          <div id ="buttonsDiv2" class="flex justify-center">
            <button id = "1Button" value ="1" name="rightWrong" class="grow m-3">Wrong Answer</button>
            <button id = "2Button" value ="2" name="rightWrong" class="grow m-3">Correct Answer</button>
            <button id = "0Button" value ="0" name="rightWrong" class="grow m-3 hidden">Next Question</button>
          </div>
        </div>

      </form>

    </div>

    <?php } ?>
    
    <script >

      function showAnswers() {
        var answerDiv = document.getElementById("answerDiv");
        answerDiv.classList.remove("hidden");

      }

      function hideButtons() {

        var buttonsDiv = document.getElementById("buttonsDiv");
        buttonsDiv.classList.add("hidden");

      }

      function swapButtons() {
        var Button0 = document.getElementById("0Button");
        var Button1 = document.getElementById("1Button");
        var Button2 = document.getElementById("2Button");

        Button1.classList.add("hidden");
        Button2.classList.add("hidden");
        Button0.classList.remove("hidden");

      }



    </script>
  </body>
</html>