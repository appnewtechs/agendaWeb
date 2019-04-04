<?php
    require_once "../bootstrap.php";

    $id_linha_produto = $_POST["id_linha_produto"];
    $descricao = $_POST["descricao"];
    $codigo = $_POST["codigo"];
    session_start();

    if(alteraLinhaProduto($conexao, $id_linha_produto, $codigo, $descricao)){
        $_SESSION["sucesso"] = "Linha de produto atualizada com sucesso!";
        header("Location: linha-produto.php");
        die();
    }else{
        $_SESSION["danger"] = "Linha de produto não atualizada. Verifique se o código já existe para outro Linha de produto!";
        header("Location: linha-produto.php");
        die();
    }
