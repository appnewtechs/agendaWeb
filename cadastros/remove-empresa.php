<?php 
	require_once("../banco-cadastros.php");
	$id_empresa = $_POST["id_empresa"];
	session_start();
	if(removeEmpresa($conexao, $id_empresa)){
		$_SESSION["sucesso"] = "Empresa removido com sucesso!";
		header("Location: empresa.php");
		die();
	}else{
		$_SESSION["danger"] = "Empresa não removido. Verifique os dados!";
		header("Location: empresa.php");
		die();
	};	
	
?>

