<?php 
	require_once("../banco-home.php");

	$descricao = $_POST["descricao"];
	$id_usuario_destinatario = $_POST["id_usuario"];
	$id_usuario_remetente = $_POST["id_usuario_remetente"];
	session_start();

	if(insereLembrete($conexao, $descricao, $id_usuario_destinatario, $id_usuario_remetente)){
		$_SESSION["sucesso"] = "Lembrete cadastrado com sucesso!";
		header("Location: ../home.php");
		die();
	}else{
		$_SESSION["danger"] = "Lembrete não cadastrado. Verifique os dados!";
		header("Location: ../home.php");
		die();
	}	

?>