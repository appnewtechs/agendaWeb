<?php require_once("../cabecalho.php") ?>
<?php

    @$id_tela = $_GET['id'];

function selecionaImagemFundo($conexao,$id){
  $array = array();
 
  $query ="SELECT telafundo FROM telas WHERE id='$id'";
  $resultado = mysqli_query($conexao, $query);
  while ($telafundo = mysqli_fetch_assoc($resultado)) {
    array_push($array, $telafundo);
  }
  return $array;
}


@$telafundo = selecionaImagemFundo($conexao,$id_tela)[0]['telafundo'];

?>

<div class="col-xs-12 breadcrumb">
	<span>ADMIN > TELA DE LOGIN</span>
</div>
<?php
if(isset($_SESSION["sucesso"])) {
  echo "<p class='alert-success'>".$_SESSION["sucesso"]."</p>";
  unset($_SESSION["sucesso"]);
}
if(isset($_SESSION["danger"])){
  echo "<p class='alert-danger'>".$_SESSION["danger"]."</p>";
  unset($_SESSION["danger"]);
}

?>

<style>
  .botao_salvar{
    margin-top: 20px;
    float: right;
  }

  .upload_container{
    margin: 20px 0;
    text-align: left;
    line-height: 50px;
  }

  .blank{
    margin-top: 20px;
    display: block;
  }
</style>
<!-- LISTA DADOS JÁ INCLUSOS NO BANCO -->

      <div class="row">
        <div class="col-xs-6">
          <?php
            if(strlen($telafundo) > 0 ){
          ?>
            <img width="400px" src="<?php echo $base_url.'/'.$telafundo ?>" />
          <?php
        }else{
          ?>
            <span class="blank">Nenhuma imagem na tela de fundo</span>
          <?php
          }
          ?>
        </div>
        <div class="col-xs-6">
          <form method="POST" enctype="multipart/form-data" action="../altera_telafundo_home.php">
            <div class="form-group col-md-12">
              <input type="hidden" name="id" value="<?php echo $id_tela; ?>">
                <label class="col-form-label">Uploade da imagem de fundo (.jpeg, .jpg ou .png)</label>
                <div class="form-group ">
                  <label class="btn col-md-12 btn-default upload_container">
                      Selecionar arquivo <input type="file" name="imagemUsuario">
                  </label>
                </div>
            </div>
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-success botao_salvar" name="botaoEnviar">Salvar</button>
            </div>
          </form>
        </div>
      </div>


<!-- MODAL PARA CADASTRO DE NOVA FRASE -->



<?php include("../rodape.php") ?>