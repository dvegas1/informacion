<?php
$allowedDomains = array("https://informacion.herokuapp.com", "https://informacion.herokuapp.com");

if (in_array($_SERVER['HTTP_HOST'], $allowedDomains)) {
	$validDomain = "true";
} else {
	$validDomain = "false";
}
?>