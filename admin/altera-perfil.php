<?php 
require_once("../bootstrap.php");
$id_perfil = $_POST["id_perfil"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
session_start();
$rotinas = array();
$todasRotinas = buscaRotinas($conexao);
foreach ($todasRotinas as $key => $rotina) {
    $escolha = array(
        "id_rotina" => $rotina['id_rotina'],
        "rotina" => $rotina['nome'],
        "edicao" => isset($_POST["edicao" . $key]),
        "visualizacao" => isset($_POST["visualizacao" . $key])
    );
    array_push($rotinas, $escolha);
}
if ($rotinas != null) {
    if (alteraPerfil($conexao, $id_perfil, $nome, $descricao, $rotinas)) {
        $_SESSION["sucesso"] = "Perfil atualizado com sucesso!";
        header("Location: perfil.php");
        die();
    } else {
        $_SESSION["danger"] = "Perfil não atualizado. Já existe um com esse nome!";
        header("Location: perfil.php");
        die();
    }
} else {
    $_SESSION["danger"] = "Rotina não informada, informe uma rotina";
    header("Location: perfil.php");
    die();
}
 