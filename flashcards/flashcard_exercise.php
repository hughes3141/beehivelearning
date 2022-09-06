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


print_r($_SESSION);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


print_r($_POST);


$stmt = $conn->prepare("INSERT INTO flashcard_responses (questionId,  userId, gotRight) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $questionId, $userId, $gotRight);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 

{
  $questionId = $_POST['questionId'];
  $userId = $_SESSION['userid'];
  $gotRight = $_POST['rightWrong'];


  $stmt->execute();
    
  echo "New records created successfully";

  
}

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
    <link rel="stylesheet" href="">
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->



    <h1>Flashcard Exercise</h1>

    <?php

      $sql="SELECT * FROM groups WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_SESSION['groupid']);
      $stmt->execute();
      $result = $stmt->get_result();
      $user = $result->fetch_assoc();

      print_r($user);

      $teachers = $user['teachers'];

      echo "<br>".$teachers;

      $teachers = json_decode($teachers);

      echo "<br>";
      print_r($teachers);


      $teacher = $teachers[0];

      echo "<br>".$teacher;


      $sql="SELECT * FROM saq_question_bank_3 WHERE userCreate = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $teacher);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result ->num_rows >0) {
        while ($row=$result->fetch_assoc()) {
          print_r($row);

          echo "<h3>".$row['question']."</h3>";
          echo "<p>Topic: ".$row['topic']."</p>";
          echo "<p>Answer: ".$row['model_answer']."</p>";
          echo "<form method ='post'>";
          echo "<button name='rightWrong' value = '0'>Don't know</button><br>";
          echo "<button name='rightWrong' value = '0'>Got Wrong</button><br>";
          echo "<button name='rightWrong' value = '1'>Got Right</button><br>";
          echo "<input type='hidden' name='questionId' value = '".$row['id']."'>";
          echo "</form>";
          
        }
      }


    ?>


   
    
    <script src="" async defer></script>
  </body>
</html>