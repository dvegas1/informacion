<?php
$allowedDomains = array("https://telohago.herokuapp.com\informacion", "https://telohago.herokuapp.com\informacion");

if (in_array($_SERVER['HTTP_HOST'], $allowedDomains)) {
	$validDomain = "true";
} else {
	$validDomain = "false";
}
?>