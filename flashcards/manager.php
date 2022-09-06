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

echo "<br>";

print_r($_POST);

$stmt = $conn->prepare("INSERT INTO saq_question_bank_3 (topic, question, type, model_answer, userCreate) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("ssssi", $topic, $question, $type, $model_answer, $userCreate);

if (isset($_POST['submit'])) {
  
  $count = $_POST['questionsCount'];
  for($x=0; $x<$count; $x++) {
    $topic = $_POST['topic_'.$x];
    $question = $_POST['question_'.$x];
    //$points = $_POST['points_'.$x];
    $type = "flashCard";
    //$image = $_POST['image_'.$x];
    $model_answer = $_POST['model_answer_'.$x];
    $userCreate = $_SESSION['userid'];
  
    $stmt->execute();
    
    echo "New records created successfully";

  }
 
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

    <style>

      th, td {

      border: 1px solid black;
      padding: 5px;

      }

      table {
        
        border-collapse: collapse;
        
      }


    </style>
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <?php if (($_SESSION['usertype']=="teacher")or($_SESSION['usertype']=="admin")) {

      ?>

    <h1>Application Manager</h1>

    <h2>Add Questions</h2>
    <p>Use the form below to enter questions.</p>
    <form method="post">
      <table id="question_input_table">
      <tr>
        <th>Topic</th>
        
        <th>Question</th>
        <!--
        <th>img src</th>
        <th>Points</th>
        <th>Source</th>
    -->
        <th>Model Answer/Mark Scheme</th>
      
      </tr>
    </table>
    <p>
      <button type = "button" onclick="addRow()">Add Row</button>
    </p>
    <p>
      <input type="submit" name="submit" value="Create Question"></input>
    </p>
    
    <input type="hidden" name="questionsCount" id="questionsCount">
    
  </form>
  


        <?php }  ?>
    





    
    <script src="" async defer></script>
    <script>
      addRow();
     

        function sourceAmend(i) {
          
          var source = document.getElementById("type_"+i);
          if (i>0) {
            var prevSource = document.getElementById("type_"+(i-1)).value;
            source.value = prevSource;
          }
          
          
          
        }

        function addRow() {
          
          var table = document.getElementById("question_input_table");
          var tableLength = table.rows.length;
          var row = table.insertRow(tableLength);

          var cell0 = row.insertCell(0);
          var cell1 = row.insertCell(1);
          //var cell2 = row.insertCell(2);
          //var cell3 = row.insertCell(3);
          //var cell4 = row.insertCell(4);
          var cell5 = row.insertCell(2);
          
          var inst = tableLength -1;

          cell0.innerHTML = '<label for="topic_'+inst+'">Topic:</label><input id ="topic_'+inst+'" name="topic_'+inst+'" class="topicSelector"></select>';
          
          cell1.innerHTML = '<label for="question_'+inst+'">Question:</label><textarea type="text" id ="question_'+inst+'" name="question_'+inst+'" required></textarea>';
          //cell2.innerHTML = '<label for="image_'+inst+'">img src:</label><input type="text" id ="image_'+inst+'" name="image_'+inst+'"></input>';
          //cell3.innerHTML = '<label for="points_'+inst+'">Points:</label><input type="number" id ="points_'+inst+'" name="points_'+inst+'"></input>';
          //cell4.innerHTML = '<label for="type_'+inst+'">Source:</label><input type="text" id ="type_'+inst+'" name="type_'+inst+'"></input>';
          cell5.innerHTML = '<label for="model_answer_'+inst+'">Model Answer/Mark Scheme:</label><textarea type="text" id ="model_answer_'+inst+'" name="model_answer_'+inst+'"></textarea>';
          
          //topicListAmend(inst);
          //sourceAmend(inst)
          
          document.getElementById("questionsCount").value = tableLength;

          
        }  
    </script>
  </body>
</html>