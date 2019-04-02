<?php 
	require_once("../banco-cadastros.php");
	$id_trabalho = $_POST["id_trabalho"];
	session_start();
	if(removeTrabalho($conexao, $id_trabalho)){
		$_SESSION["sucesso"] = "Trabalho removido com sucesso!";
		header("Location: trabalho.php");
		die();
	}else{
		$_SESSION["danger"] = "Trabalho não removido. Verifique os dados!";
		header("Location: trabalho.php");
		die();
	};	
	
?>

