<?php
include("functions.php");

if($_GET['uid']!=""){
  $getuid = $_GET['uid'];
  
  $mycommand = "SELECT * FROM messages WHERE uid='$getuid'";
  

  foreach ($connect->query($mycommand) as $row) {
    $spacedmessage = str_replace("*", " ", $row['message']);
	echo $spacedmessage;
	echo "<br/>";
  }
} else {

	$mycommand = "SELECT * FROM messages";
	
	//$mycommand1 = pg_query($mycommand) or die('La consulta fallo: ' . pg_last_error());


//$result=pg_query($connect,$mycommand);

	foreach (pg_query($connect,$mycommand) as $row) {
	  $spacedmessage = str_replace("*", " ", $row['message']);
	  echo "<strong>" . $row['uid'] . ":</strong> ";
      echo $spacedmessage;
	  echo "<br/>";
    }
}

?>