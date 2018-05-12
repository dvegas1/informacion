<?php
$url = "https://telohago.herokuapp.com\informacion";

if (file_exists("config.php")) {
  include("config.php");
} else {
  header('Location: setup/');
}

session_start();
if (empty($_SESSION['code'])) {
  header( 'Location: index.php' ) ;
  die();
}

include("functions.php");

$statement = $connect->prepare("TRUNCATE TABLE commands");
$statement->execute();header('Location: settings.php');

?>