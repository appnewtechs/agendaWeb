<?php 
	require_once("../banco-cadastros.php");

	$descricao = $_POST["descricao"];
	$codigo = $_POST["codigo"];
	session_start();

	if(insereLinhaProduto($conexao, $codigo, $descricao)){
		$_SESSION["sucesso"] = "Linha de produto cadastrada com sucesso!";
		header("Location: linha-produto.php");
		die();
	}else{
		$_SESSION["danger"] = "Linha de produto não cadastrada. Verifique se o código já existe para outro Linha de produto!";
		header("Location: linha-produto.php");
		die();
	}	

?>