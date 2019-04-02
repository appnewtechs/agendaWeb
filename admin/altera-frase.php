<?php 
    require_once("../banco-usuario.php");

    $id_frase = $_POST["id_frase"];
    $descricao = $_POST["descricao"];
    session_start();

    if(alteraFrase($conexao, $id_frase, $descricao)){
        $_SESSION["sucesso"] = "Frase atualizada com sucesso!";
        header("Location: frase.php");
        die();
    }else{
        $_SESSION["danger"] = "Frase não atualizada. Verifique os dados!";
        header("Location: frase.php");
        die();
    }   

?>