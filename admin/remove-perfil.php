<?php 
	require_once("../banco-usuario.php");
	$id_perfil = $_POST["id_perfil"];
	session_start();
	if(removePerfil($conexao, $id_perfil)){
		$_SESSION["sucesso"] = "Perfil removido com sucesso!";
		header("Location: perfil.php");
		die();
	}else{
		$_SESSION["danger"] = "Perfil não removido. Verifique os dados!";
		header("Location: perfil.php");
		die();
	};	
	
?>

