<?php 
	require_once("../banco-cadastros.php");

	$codigo = $_POST["codigo"];
	$descricao = $_POST["descricao"];
	$cliente_fornecedor = $_POST["cliente_fornecedor"];
	// $prestador_servico = 0;
 //    if(isset($_POST["prestador_servico"])){$prestador_servico=1;}
	session_start();
		// var_dump($prestador_servico);
	if(insereTipoEmpresa($conexao, $codigo, $descricao, $cliente_fornecedor)){
		$_SESSION["sucesso"] = "Tipo de empresa cadastrado com sucesso!";
		header("Location: tipo-empresa.php");
		die();
	}else{
		$_SESSION["danger"] = "Tipo de empresa não cadastrado. Verifique o código!";
		header("Location: tipo-empresa.php");
		die();
	}	

?>