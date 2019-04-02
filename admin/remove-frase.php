<?php 
	require_once("../banco-usuario.php");
	$id_frase = $_POST["id_frase"];
	session_start();
	if(removeFrase($conexao, $id_frase)){
		$_SESSION["sucesso"] = "Frase removida com sucesso!";
		header("Location: frase.php");
		die();
	}else{
		$_SESSION["danger"] = "Frase não removida. Verifique os dados!";
		header("Location: frase.php");
		die();
	};	
	
?>

