<?php
$HostName = "localhost";
 

$DatabaseName = "databasename";
 

$HostUser = "username";
 

$HostPass = "password";
$con=mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

if(!$con){
	die("Connection failed:".mysqli_connect_error());
}
?>
