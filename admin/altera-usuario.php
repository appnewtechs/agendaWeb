<?php
require_once "../bootstrap.php";

$id_usuario = $_POST["id_usuario"];
$senha = $_POST["senha"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$perfis = $_POST["perfis"];
$cor = $_POST["cor"];
$data_nascimento = $_POST["data_nascimento"];
$login = $_POST["login"];
$id_linha_produto = $_POST["linha_produto"];
$id_empresa = $_POST["empresa"];
$especialidade = $_POST["especialidade"];
$status = $_POST["status"];
session_start();

if (strlen($_POST["imagem"]) > 0) {
    $imagem = $_POST["imagem"];
} else {
    $imagem = "";
}

if (strlen($_FILES['imagemUsuario']['name']) > 0) {
    $ext = strtolower(substr($_FILES['imagemUsuario']['name'], -4));
    $allowedExts = array(".jpeg", ".jpg", ".png");
    if (!in_array($ext, $allowedExts)) {
        $_SESSION["danger"] = "Extensão da imagem deve ser .jpeg, .jpg ou .png!";
        header("Location: usuarios.php");
        die();
    }
    $new_name = date("Y.m.d-H.i.s") . $nome . $ext;
    $dir = "/uploads/";
    move_uploaded_file($_FILES['imagemUsuario']['tmp_name'], "../" . $dir . $new_name);

    $imagem = $dir . $new_name;
}

if ($perfis != null) {
    if (alteraUsuario($conexao, $id_usuario, $senha, $nome, $data_nascimento, $email, $telefone, $perfis, $cor, $imagem, $login, $id_linha_produto, $id_empresa, $especialidade, $status)) {
        $_SESSION["sucesso"] = "Usuário atualizado com sucesso!";
        header("Location: usuarios.php");
        die();
    } else {
        $_SESSION["danger"] = "Usuário não atualizado. Verifique os dados!";
        header("Location: usuarios.php");
        die();
    }
} else {
    $_SESSION["danger"] = "Não cadastrado. Selecione um perfil!";
    header("Location: usuarios.php");
    die();
}
 