<?php

include("../cabecalho.php"); 
//include("logica-usuario.php");
// include("banco-usuario.php");

verificaUsuario();
$mensagem_resultado = "";
if (isset($_POST['senha_nova'])) {
  if ((md5($_POST['senha_atual']) === $_SESSION["senha"]) && ($_POST['senha_nova'] === $_POST['confirme_senha'])) {
  	if(alterarSenha($conexao, $_SESSION['login'], md5($_POST['senha_nova']))){
  		$_SESSION["sucesso"] = "Senha alterada com sucesso";
  		$_SESSION["senha"] = md5($_POST['senha_nova']);
  	}else{
  		$_SESSION["danger"] = "Erro inesperado, contacte o suporte.";
  	}
  } else {
  	if((md5($_POST['senha_atual']) !== $_SESSION["senha"])){
      $_SESSION["danger"] = "Senha atual incorreta";
  	}
  	if($_POST['senha_nova'] !== $_POST['confirme_senha']){
		 $_SESSION["danger"] = "A senha nova não confere com a confirmação, digite novamente.";
	  }
  }
}
if(isset($_POST['id_usuario'])){
  if(editaPerfil($conexao, $_POST['id_usuario'], $_POST['nome'], $_POST['email'], $_POST['telefone'])){
    $_SESSION["sucesso"] = "Usuário alterado com sucesso";
  }else{
    $_SESSION["danger"] = "Erro inesperado";
  }
}
if(isset($_SESSION["sucesso"])) {
  echo "<p class='alert-success'>".$_SESSION["sucesso"]."</p>";
  unset($_SESSION["sucesso"]);
}
if(isset($_SESSION["danger"])){
  echo "<p class='alert-danger'>".$_SESSION["danger"]."</p>";
  unset($_SESSION["danger"]);
}

$usuario = buscaUsuario($conexao, $_SESSION["login"]);
?>



<div class="editarperfil">
  <h3>Editar Perfil</h3>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu1">Informações Gerais</a></li>
    <li><a data-toggle="tab" href="#menu2">Senha</a></li>
  </ul>

  <div class="tab-content">
    <div id="menu1" class="tab-pane fade in active">
      <form name="form_editar_perfil" action="editarperfil.php" class="form-horizontal" method="post">
        <fieldset class="form-editarperfil">
        <div class="form-group">
            <label class="control-label col-sm-3" for="login">Usuario</label>
            <div class="col-sm-9">
              <input disabled class="form-control" value="<?= $usuario['login'];?>" type="text" name="login" id="login" required="true">
            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario']?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nome_usuario">Nome</label>
            <div class="col-sm-9"> 
              <input class="form-control" value="<?= $usuario['nome'];?>" type="text" name="nome" required="true">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email">E-mail</label>
            <div class="col-sm-9"> 
              <input class="form-control" value="<?= $usuario['email'];?>" type="text" name="email" required="true">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="telefone">Telefone</label>
            <div class="col-sm-9"> 
              <input class="form-control" value="<?= $usuario['telefone'];?>" type="text" name="telefone" required="true">
            </div>
        </div>
        <div class="form-row">
          <div class="modal-footer">
            <button type="submit" class="btn">Salvar</button>
          </div>
        </div>
        </fieldset>
      </form>
    </div>
    <div id="menu2" class="tab-pane fade">
      <form name="form_editar_senha" action="editarperfil.php" class="form-horizontal" method="post">
        <fieldset>
          <div class="form-trocarsenha">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-4 col-form-label">Senha atual</label>
              <div class="col-sm-8">
                <input type="password" required class="form-control" id="inputPassword" name="senha_atual" placeholder="Digite sua senha atual...">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-4 col-form-label">Senha nova</label>
              <div class="col-sm-8">
                <input type="password" required class="form-control" id="inputPassword" name="senha_nova" placeholder="Digite sua senha nova...">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-4 col-form-label">Confirme senha</label>
              <div class="col-sm-8">
                <input type="password" required class="form-control" id="confirme_senha" name="confirme_senha" placeholder="Confirme sua senha nova...">
              </div>
            </div>
            <div class="form-row">
              <div class="modal-footer">
                <button type="submit" class="btn">Salvar</button>
              </div>
            </div>
          </div>
        </fieldset>
      </form>  
    </div>
  </div>
</div>



<script>
$( document ).ready(function() {
    $('#menu2').collapse('toggle');
});
</script>

<?php include("../rodape.php") ?>