<?php 
	require_once "../bootstrap.php";
	$id_cliente = $_POST["id_cliente"];
	session_start();
	if(removeCliente($conexao, $id_cliente)){
		$_SESSION["sucesso"] = "Cliente removido com sucesso!";
		header("Location: cliente.php");
		die();
	}else{
		$_SESSION["danger"] = "Cliente não removido. Verifique os dados!";
		header("Location: cliente.php");
		die();
	};
