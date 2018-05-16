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
  
  $statement = pg_query($connect,"SELECT blocked FROM bots WHERE uid='$botid'");
  
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  
  $curblocked = $result[blocked];
  
  if($curblocked == "yes"){
    $statement = pg_query($connect,"UPDATE bots SET blocked='no' WHERE `uid` = '$botid'");

    $statement->execute();
    echo "Bot History Unblocked";
  } else {

    $statement = pg_query($connect,"UPDATE bots SET blocked='yes' WHERE 'uid' = '$botid'");

	echo "Bot History Blocked";
  }
?>