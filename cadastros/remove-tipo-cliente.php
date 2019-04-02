<?php 
	require_once("../banco-cadastros.php");
	$id_tipo_cliente = $_POST["id_tipo_cliente"];
	session_start();
	if(removeTipoCliente($conexao, $id_tipo_cliente)){
		$_SESSION["sucesso"] = "Tipo de cliente removido com sucesso!";
		header("Location: tipo-cliente.php");
		die();
	}else{
		$_SESSION["danger"] = "Tipo de cliente não removido. Existem cliente(s) com esse tipo!";
		header("Location: tipo-cliente.php");
		die();
	};	
	
?>

