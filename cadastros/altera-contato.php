<?php 
    require_once("../banco-cadastros.php");

    $id_contato = $_POST["id_contato"];
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

    if(alteraContato($conexao, $id_cliente, $id_contato, $nome, $data_nascimento, $telefone, $telefone2, $telefone3, $email, $area_contato, $observacao)){
        $_SESSION["sucesso"] = "Contato atualizado com sucesso!";
        header("Location: contato.php");
        die();
    }else{
        $_SESSION["danger"] = "Contato não atualizado. Verifique os dados!";
        header("Location: contato.php");
        die();
    }   

?>