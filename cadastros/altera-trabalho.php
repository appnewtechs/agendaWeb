<?php
require_once "../bootstrap.php";

$id_trabalho = $_POST["id_trabalho"];
$codigo = $_POST["codigo"];
$descricao = $_POST["descricao"];
$cor = $_POST["cor"];
session_start();

if (alteraTrabalho($conexao, $id_trabalho, $codigo, $descricao, $cor)) {
    $_SESSION["sucesso"] = "Trabalho atualizado com sucesso!";
    header("Location: trabalho.php");
    die();
} else {
    $_SESSION["danger"] = "Trabalho não atualizado. Verifique os dados!";
    header("Location: trabalho.php");
    die();
}
