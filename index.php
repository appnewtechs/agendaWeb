<?php include("cabecalho-login.php") ?>
<?php include("logica-usuario.php") ?>
<?php include("banco-usuario.php") ?>
<?php

  include("banco-telalogin.php");
  $telafundo = selecionaImagemFundo($conexao)[0]['telafundo'];

?>

<style>
html, body {
  background: url('<?php echo $base_url.'/'.$telafundo ?>') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>


<div class="login-form col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">

<?php
if(isset ($_SESSION["danger"])) {
?>
<p class="alert-danger"><?= $_SESSION["danger"]?></p>
<?php
unset($_SESSION["danger"]);
}
?>
    <!-- <header>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="imagem imagem2 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <img src="img/NEWTECH_IDEA-01_modificado.png" align="right">
            </div>

            <div class="imagem col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <img src="img/logo-new.png" align="center" style="padding-top: 20px">
            </div>

        </div>

    </header> -->

    <?php
        if(isset($_POST['acao']) && $_POST['acao'] == 'recuperar'):
            $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
            $verificarUsuario = verificarUsuario($conexao,$email);
            // var_dump($verificarUsuario);
            // var_dump($verificarUsuario[0]['email']);
            if($verificarUsuario[0]['email'] == $email){
                $codigo = base64_encode($email);
                $data_expirar = date('Y-m-d H:i:s', strtotime('+1 day'));
                $mensagem = '<p>Recebemos uma tentativa de recuperação de senha para este e-mail, caso não tenha sido você,
                    desconsidere este e-mail, caso contrário clique no link abaixo<br />
                    <a href="http://localhost:81/monster/recuperar.php?codigo='.$codigo.'">Recuperar Senha</a></p>';
                $email_remetente = 'francisco.perdona@gmail.com';

                $headers = "MIME-Version: 1.1\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                $headers .= "From: $email_remetente\n";
                $headers .= "Return-Path: $email_remetente\n";
                $headers .= "Reply-To: $email\n";

                $inserirCodigo = inserirCodigo($conexao, $codigo, $data_expirar);
                if($inserirCodigo){
                    if(mail("$email", "Assunto", "$mensagem", $headers, "-f$email_remetente")){
                        echo 'Enviamos um e-mail com um link para recuperação de senha, para o endereço de e-mail informado!';
                    }
                }
            }
        endif;
    ?>
        <?php
            if(isset($_GET['recuperar']) && $_GET['recuperar'] == 'sim'){
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input type="text" name="email" value="" class="form-control" placeholder="Email" required="true"/>
                    </div>
                </div>
                <input type="hidden" name="acao" value="recuperar" />
                <footer>
                    <a href="index.php">Logar</a>
                    <button type="submit" class="btn btn-default pull-right">Recuperar Senha</button>
                </footer>
            </form>
        <?php }else{ ?>
            <form name="form_login_usuario" action="login.php" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input type="text" name="login" id="login" class="form-control" placeholder="Login" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </div>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="true">
                    </div>
                </div>
                <footer>
                    <div class="checkbox pull-left">
                        <label class="lembrar"><input type="checkbox" id="chk_lembrar" name="lembrar">Lembrar de mim</label>
                        <!-- <a href="?recuperar=sim">Esqueceu sua senha?</a> -->
                    </div>
                    <button type="submit" class="btn btn-default pull-right">Login</button>
                </footer>
            </form>
        <?php }?>
<script type="text/javascript">
 // window.onload = function checkLembrar() {
function checkLembrar() {
    document.getElementById("chk_lembrar").checked = true;
}

</script>

<?php
if(isset($_COOKIE['usuario_monster']) and isset($_COOKIE['senha_monster'])){
    $usuario = $_COOKIE['usuario_monster'];
    $senha = $_COOKIE['senha_monster'];
    $_chkLembrar = true;
    echo "<script>
            document.getElementById('login').value = '$usuario';
            document.getElementById('senha').value = '$senha';
            checkLembrar();
    </script>";
}else{
    $_chkLembrar = false;
}
 ?>

</div>

</div>
<?php //include("rodape-login.php") ?>