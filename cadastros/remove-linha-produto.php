<?php 
	require_once("../banco-cadastros.php");
	$id_linha_produto = $_POST["id_linha_produto"];
	session_start();
	if(removeLinhaProduto($conexao, $id_linha_produto)){
		$_SESSION["sucesso"] = "Linha de produto removido com sucesso!";
		header("Location: linha-produto.php");
		die();
	}else{
		$_SESSION["danger"] = "Linha de produto não removido. Verifique os dados!";
		header("Location: linha-produto.php");
		die();
	};	
	
?>

