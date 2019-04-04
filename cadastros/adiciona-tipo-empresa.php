<?php
require_once "../bootstrap.php";

$codigo = $_POST["codigo"];
$descricao = $_POST["descricao"];
$cliente_fornecedor = $_POST["cliente_fornecedor"];
session_start();
if (insereTipoEmpresa($conexao, $codigo, $descricao, $cliente_fornecedor)) {
	$_SESSION["sucesso"] = "Tipo de empresa cadastrado com sucesso!";
	header("Location: tipo-empresa.php");
	die();
} else {
	$_SESSION["danger"] = "Tipo de empresa não cadastrado. Verifique o código!";
	header("Location: tipo-empresa.php");
	die();
}
