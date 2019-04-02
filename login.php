<?php
require_once("banco-usuario.php");
require_once("banco-cadastros.php");
require_once("logica-usuario.php");
require_once("funcoes.php");

$usuario = login($conexao, $_POST["login"], $_POST["senha"]);
$rotina = buscaRotinaUsuario($conexao,$usuario['id_usuario']);
$permissoesRotina = buscaRotinaUsuarioPermissoes($conexao,$usuario['id_usuario']);
if($usuario == null) {
	$_SESSION["danger"] = "Usuário ou senha inválida.";
	header("Location: index.php");
    die();
} else {

if(isset($_POST["lembrar"])){
	setcookie("usuario_monster", $_POST["login"], time() + 3600*3600);
	setcookie("senha_monster", $_POST["senha"], time() + 3600*3600);
}

		logaUsuario($usuario["login"], $usuario["senha"],  $usuario["imagem"], $rotina, $permissoesRotina);
		$usuarioLogado = buscaUsuario($conexao,$_SESSION["login"]);
    $isCliente = verificaUsuarioCliente($conexao,$usuarioLogado["id_usuario"]);
    if(!empty($isCliente)){
    	header("Location: eventos/agenda.php");
    }else{
		header("Location: home.php");
    }
}
die();


