<?php 
    require_once("../banco-cadastros.php");

    $id_tipo_cliente = $_POST["id_tipo_cliente"];
    $descricao = $_POST["descricao"];
    $codigo = $_POST["codigo"];
    $cliente_fornecedor = $_POST["cliente_fornecedor"];
    // $prestador_servico = 0;
    // if(isset($_POST["prestador_servico"])){$prestador_servico=1;}
    // session_start();

    if(alteraTipoCliente($conexao, $id_tipo_cliente, $codigo, $descricao, $cliente_fornecedor)){
        $_SESSION["sucesso"] = "Tipo de cliente atualizado com sucesso!";
        header("Location: tipo-cliente.php");
        die();
    }else{
        $_SESSION["danger"] = "Tipo de cliente não atualizado. Verifique o código!";
        header("Location: tipo-cliente.php");
        die();
    }   

?>