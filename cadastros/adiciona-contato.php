<?php 
	require_once("../banco-cadastros.php");

    $nome = $_POST["nome"];
    $data_nascimento = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];
    $telefone2 = $_POST["telefone2"];
    $telefone3 = $_POST["telefone3"];
    $email = $_POST["email"];
    $area_contato = $_POST["area_contato"];
    $observacao = $_POST["observacao"];
    $id_cliente = $_POST["id_cliente"];
	session_start();

	if(insereContato($conexao, $id_cliente, $nome, $data_nascimento, $telefone, $telefone2, $telefone3, $email, $area_contato, $observacao)){
		$_SESSION["sucesso"] = "Contato cadastrado com sucesso!";
		header("Location: contato.php");
		die();
	}else{
		$_SESSION["danger"] = "Contato não cadastrado. Verifique se informou o cliente correto!";
		header("Location: contato.php");
		die();
	}	

?>