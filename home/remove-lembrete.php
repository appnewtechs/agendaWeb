<?php 
	require_once("../bootstrap.php");
	$id_lembrete = $_POST["id_lembrete"];
	session_start();
	if(removeLembrete($conexao, $id_lembrete)){
		$_SESSION["sucesso"] = "Lembrete removido com sucesso!";
		header("Location: ../home.php");
		die();
	}else{
		$_SESSION["danger"] = "Lembrete não removido. Verifique os dados!";
		header("Location: ../home.php");
		die();
	}	
?>

