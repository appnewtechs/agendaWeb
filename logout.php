<?php require_once("logica-usuario.php"); 

if(isset($_SESSION["login"])){
	logout();
	header("Location: index.php");
	die();
}