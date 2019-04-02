<?php

    include('conecta.php');

    session_start();

    if(isset($_FILES['imagemUsuario'])){
      $ext = strtolower(substr($_FILES['imagemUsuario']['name'],-4));
      $allowedExts = array(".jpeg", ".jpg", ".png");
      if(!in_array($ext, $allowedExts)) {
        $_SESSION["danger"] = "Extensão da imagem deve ser .jpeg, .jpg ou .png!";
        header("Location: admin/telalogin.php");
        die();
      }
      $new_name = date("Y.m.d-H.i.s").'telafundo' . $ext;
      $dir = "uploads/";
      move_uploaded_file($_FILES['imagemUsuario']['tmp_name'], $dir.$new_name);

      $query = "UPDATE config set telafundo = '".$dir.$new_name."'";
      $resultado = mysqli_query($conexao, $query);

    if($resultado){
      $_SESSION["sucesso"] = "Tela de fundo alterada com sucesso!";
  		header("Location: admin/telalogin.php");
  		die();
    }else{
  		$_SESSION["danger"] = "Algum problema ocorreu ao alterar a tela de fundo!";
  		header("Location: admin/telalogin.php");
  		die();
  	}

    }
?>