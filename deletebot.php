<?php
  $url = "https://informacion.herokuapp.com";

  if (file_exists("config.php")) {
    include("config.php");
  } else {
    die();
  }
  
  include("functions.php");
  
  $botid = $_GET['uid'];
  
  if (empty($botid)){
    die();
  }
  
  echo $botid;
  
  $statement = pg_query($connect,"DELETE FROM bots WHERE uid='$botid'");

  echo "Bot Deleted";
?>