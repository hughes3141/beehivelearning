<?php
session_start();

$previous = "";
if($_SESSION['last_url']) {
  $previous = $_SESSION['last_url'];
}
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();




header("location: /flashcards");


?>

</body>
</html>