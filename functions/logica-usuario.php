<?php

session_cache_expire(180);
session_start();

function logaUsuario($login, $senha, $imagem, $rotina, $permissoesRotina){
		$_SESSION["login"] = $login;
		$_SESSION["senha"] = $senha;
		$_SESSION["imagem"] = $imagem;
		$_SESSION["rotina"] = $rotina;
		$_SESSION["permissoesRotina"] = $permissoesRotina;
}

function verificaUsuario(){
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:index.php');
		die();
	}
}

function logout(){
	session_destroy();
}
