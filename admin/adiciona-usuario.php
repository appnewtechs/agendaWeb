<?php
	require_once("../banco-usuario.php");

	$login = $_POST["login"];
	$senha = $_POST["senha"];
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$telefone = $_POST["telefone"];
	$perfis = $_POST["perfis"];
	$cor = $_POST["cor"];
	$data_nascimento = $_POST["data_nascimento"];
	$id_linha_produto = $_POST["linha_produto"];
    $id_empresa = $_POST["empresa"];
    $especialidade = $_POST["especialidade"];

	if(strlen($_POST["imagem"]) > 0 ){
    $imagem = $_POST["imagem"];
   }else{
    $imagem = "";
   }

	session_start();

		if(strlen($_FILES['imagemUsuario']['name']) > 0 ){
			$ext = strtolower(substr($_FILES['imagemUsuario']['name'],-4));
			$allowedExts = array(".jpeg", ".jpg", ".png");
			if(!in_array($ext, $allowedExts)) {
				$_SESSION["danger"] = "Extensão da imagem deve ser .jpeg, .jpg ou .png!";
				header("Location: usuarios.php");
				die();
			}
			$new_name = date("Y.m.d-H.i.s").$nome . $ext;
			$dir = "/uploads/";
			move_uploaded_file($_FILES['imagemUsuario']['tmp_name'], "../".$dir.$new_name);

			$imagem = $dir.$new_name;
		}

	if($perfis != null){
		if(insereUsuario($conexao, $login, $senha, $nome, $data_nascimento, $email, $telefone, $perfis, $cor, $imagem, $id_linha_produto, $id_empresa,$especialidade)){
			$_SESSION["sucesso"] = "Usuário cadastrado com sucesso!";
			header("Location: usuarios.php");
			die();
		}else{
			$_SESSION["danger"] = "Não cadastrado. Usuário ou E-mail já utilizado no sistema!";
			header("Location: usuarios.php");
			die();
		}
	}else{
		$_SESSION["danger"] = "Não cadastrado. Selecione um perfil!";
		header("Location: usuarios.php");
		die();
	}

?>