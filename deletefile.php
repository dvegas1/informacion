<?php
  $url = "https://informacion.herokuapp.com";

  if (file_exists("config.php")) {
    include("config.php");
  } else {
    die();
  }
  
  include("functions.php");
  
  $filename = $_GET['file'];
  
  if (empty($filename)){
    die();
  }
  
  $path = realpath('dlfiles/');
  
  if (is_readable($path . '/' . $filename)) {
    unlink($path . '/' . $filename);

  $statement = pg_query($connect,"DELETE FROM files WHERE file='$filename'");


	echo "Deleted";
  } else {
    die();
  }
?>