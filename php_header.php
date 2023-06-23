<?php



//Commands which are common to all scripts:

  /*
  // Initialize the session
  session_start();

  $_SESSION['this_url'] = $_SERVER['REQUEST_URI'];

  
  if (!isset($_SESSION['userid'])) {
    
    header("location: /login.php");
    
  }
  */

  date_default_timezone_set('Europe/London');

  //Define server path:
  $path2 = $_SERVER['DOCUMENT_ROOT'];
  $path2 .= "/../secrets/secrets.php";
  include($path2);

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
  }


  // Accesss thinkeconomics pathway:
  $path3 = $_SERVER['DOCUMENT_ROOT'];
  echo $path3;
  if($path3 == "C:/xampp/htdocs/beehivelearning") {  
    $path3 .= "/../thinkeconomics/php_functions.php";
  } 
  else $path3 .= "/../public_html/php_functions.php";

  include($path3);
  




?>