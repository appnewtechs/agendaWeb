<?php 
	require_once("../banco-cadastros.php");

    $codigo = $_POST["codigo"];
	$descricao = $_POST["descricao"];
	$cor = $_POST["cor"];
	session_start();

	if(insereTrabalho($conexao, $codigo, $descricao, $cor)){
		$_SESSION["sucesso"] = "Trabalho cadastrado com sucesso!";
		header("Location: trabalho.php");
		die();
	}else{
		$_SESSION["danger"] = "Trabalho não cadastrado. Verifique os dados!";
		header("Location: trabalho.php");
		die();
	}	

?>