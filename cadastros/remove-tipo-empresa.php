<?php 
	require_once("../banco-cadastros.php");
	$id_tipo_empresa = $_POST["id_tipo_empresa"];
	session_start();
	if(removeTipoEmpresa($conexao, $id_tipo_empresa)){
		$_SESSION["sucesso"] = "Tipo de empresa removido com sucesso!";
		header("Location: tipo-empresa.php");
		die();
	}else{
		$_SESSION["danger"] = "Tipo de empresa não removido. Existem empresa(s) com esse tipo!";
		header("Location: tipo-empresa.php");
		die();
	};	
	
?>

