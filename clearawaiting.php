<?php
$url = "https://informacion.herokuapp.com";

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


 $result = pg_query($connect,"TRUNCATE TABLE commands");


 header('Location: settings.php');

?>