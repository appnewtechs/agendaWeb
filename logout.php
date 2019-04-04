<?php require_once "bootstrap.php"; 

if(isset($_SESSION["login"])){
	logout();
	header("Location: index.php");
	die();
}