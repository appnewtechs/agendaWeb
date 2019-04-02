<?php 
	require_once("../banco-cadastros.php");
	$id_contato = $_POST["id_contato"];
	session_start();
	if(removeContato($conexao, $id_contato)){
		$_SESSION["sucesso"] = "Contato removido com sucesso!";
		header("Location: contato.php");
		die();
	}else{
		$_SESSION["danger"] = "Contato não removido. Verifique os dados!";
		header("Location: contato.php");
		die();
	};	
	
?>

