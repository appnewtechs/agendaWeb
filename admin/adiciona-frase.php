<?php 
	require_once("../banco-usuario.php");

	$descricao = $_POST["descricao"];
	session_start();

	if(insereFrase($conexao, $descricao)){
		$_SESSION["sucesso"] = "Frase cadastrada com sucesso!";
		header("Location: frase.php");
		die();
	}else{
		$_SESSION["danger"] = "Frase não cadastrada. Verifique os dados!";
		header("Location: frase.php");
		die();
	}	

?>