<?php 
include("cabecalho-login.php");
include("banco-usuario.php"); 
$mensagem_resultado="";
if(isset($_GET['codigo'])){
	$codigo = $_GET['codigo'];
	$cpf_cnpj = base64_decode($codigo);
	$verificarCodigo = verificarCodigo($conexao, $codigo);
	// $selecionar = mysqli_query("SELECT * FROM `codigos` WHERE codigo = '$codigo' AND data > NOW()");
	if(mysqli_num_rows($verificarCodigo) >= 1){
		if(isset($_POST['acao']) && $_POST['acao'] == 'mudar'){
			if (isset($_POST['senha_nova'])) {
			    if ($_POST['senha_nova'] === $_POST['confirme_senha']) {
			    	var_dump($cpf_cnpj);
			    	if(alterarSenha($conexao, $cpf_cnpj, md5($_POST['senha_nova']))){
						$deletarCodigo = deletarCodigo($conexao,$codigo);
						$mensagem_resultado = "A senha foi modificada com sucesso!";
			    	}else{
			    		$mensagem_resultado = "Erro inesperado, contacte o suporte.";
			    	}
			    } else {
			    	$mensagem_resultado = "A senha nova não confere com a confirmação, digite novamente.";
			    }
			}
		}
?>
<div class="login-form col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
<header>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="imagem imagem2 col-xs-6 col-sm-6 col-md-6 col-lg-6">    
                <img src="img/NEWTECH_IDEA-01_modificado.png" align="right">
            </div>

            <div class="imagem col-xs-6 col-sm-6 col-md-6 col-lg-6">    
                <img src="img/logo_estrutural.png" align="center" style="padding-top: 20px">
            </div>

        </div>

    </header>
<h1>Digite a senha nova</h1>
<?php echo $mensagem_resultado; ?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-option-horizontal"></span>
        </div>
        <input type="password" name="senha_nova" id="inputPassword" class="form-control" placeholder="Digite sua senha nova..." required="true">
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-option-horizontal"></span>
        </div>
        <input type="password" name="confirme_senha" id="confirme_senha" class="form-control" placeholder="Confirme sua senha nova..." required="true">
    </div>
</div>
<input type="hidden" name="acao" value="mudar" class="btn btn-default pull-right" />
                    <a href="index.php">Logar</a>

<input type="submit" value="Mudar Senha" class="btn btn-default pull-right"/>
</form>

</div>
<!-- </div> -->

<?php
	}else{
?>
<div class="login-form col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
<header>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="imagem imagem2 col-xs-6 col-sm-6 col-md-6 col-lg-6">    
                <img src="img/NEWTECH_IDEA-01_modificado.png" align="right">
            </div>

            <div class="imagem col-xs-6 col-sm-6 col-md-6 col-lg-6">    
                <img src="img/logo_estrutural.png" align="center" style="padding-top: 20px">
            </div>

        </div>

    </header>
<?php
		echo '<h1>Desculpe mais este link já expirou!</h1>';
?>
<a href="index.php">Logar</a>

</div>
<!-- </div> -->
<?php
	}
}?>

<?php include("rodape-login.php") ?>