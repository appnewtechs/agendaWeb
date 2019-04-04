<?php
require_once "../bootstrap.php";

$descricao = $_POST["descricao"];
$cliente_fornecedor = $_POST["cliente_fornecedor"];
$codigo = $_POST["codigo"];
session_start();

if (insereTipoCliente($conexao, $codigo, $descricao, $cliente_fornecedor)) {
	$_SESSION["sucesso"] = "Tipo de cliente cadastrado com sucesso!";
	header("Location: tipo-cliente.php");
	die();
} else {
	$_SESSION["danger"] = "Tipo de cliente não cadastrado. Verifique o código!";
	header("Location: tipo-cliente.php");
	die();
}
