<?php 
	require_once("../banco-usuario.php");
	$id_usuario = $_POST["id_usuario"];
	$login = $_POST["login"];
	session_start();
	if($_SESSION["login"] != $login){
		if(removeUsuario($conexao, $id_usuario)){
			$_SESSION["sucesso"] = "Usuário removido com sucesso!";
			header("Location: usuarios.php");
			die();
		}else{
			$_SESSION["danger"] = "Usuário não removido. Verifique os dados!";
			header("Location: usuarios.php");
			die();
		};	
	}else{
		$_SESSION["danger"] = "Você não pode se excluir.";
		header("Location: usuarios.php");
		die();
	}
	
?>

