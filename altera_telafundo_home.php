<?php

    include('conecta.php');

    session_start();

    $id = $_POST['id'];

    if(isset($_FILES['imagemUsuario'])){
      $ext = strtolower(substr($_FILES['imagemUsuario']['name'],-4));
      $allowedExts = array(".jpeg", ".jpg", ".png");
      if(!in_array($ext, $allowedExts)) {
        $_SESSION["danger"] = "Extensão da imagem deve ser .jpeg, .jpg ou .png!";
        header("Location: admin/telahome.php?id=$id");
        die();
      }
      $new_name = date("Y.m.d-H.i.s").'telafundo' . $ext;
      $dir = "uploads/";
      move_uploaded_file($_FILES['imagemUsuario']['tmp_name'], $dir.$new_name);

      $query = "UPDATE telas set telafundo = '".$dir.$new_name."' WHERE id='$id'";
      $resultado = mysqli_query($conexao, $query);

    if($resultado){
      $_SESSION["sucesso"] = "Tela de fundo alterada com sucesso!";
  		header("Location: admin/telahome.php?id=$id");
  		die();
    }else{
  		$_SESSION["danger"] = "Algum problema ocorreu ao alterar a tela de fundo!";
  		header("Location: admin/telahome.php?id=$id");
  		die();
  	}

    }
?>