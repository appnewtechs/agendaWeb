<?php
    require_once "../bootstrap.php";

    $id_tipo_cliente = $_POST["id_tipo_cliente"];
    $descricao = $_POST["descricao"];
    $codigo = $_POST["codigo"];
    $cliente_fornecedor = $_POST["cliente_fornecedor"];

    if(alteraTipoCliente($conexao, $id_tipo_cliente, $codigo, $descricao, $cliente_fornecedor)){
        $_SESSION["sucesso"] = "Tipo de cliente atualizado com sucesso!";
        header("Location: tipo-cliente.php");
        die();
    }else{
        $_SESSION["danger"] = "Tipo de cliente não atualizado. Verifique o código!";
        header("Location: tipo-cliente.php");
        die();
    }
