<style>
  .home{
    padding: 20px;
  }

  .home h3{
    margin-top: 0;
  }

  .home .clock-button{
    float: right;
    display: block;
    margin-right: 15px;
  }

  .home .home-container{
    margin-top: 30px;
  }

  .home .quote-day{
    font-style: italic;
    margin-top: 15px;
  }
</style>

<?php
  require_once("cabecalho.php");
  require_once("banco-home.php");
  require_once("banco-usuario.php");

  // $frase =  buscaFraseDoDia($conexao);
  $aniversariantes =  buscaAniversariantesDaSemana($conexao);
  $usuario = buscaUsuario($conexao,$_SESSION["login"]);
  $id_usuario_remetente = $usuario['id_usuario'];
  $lembretes = buscaLembretes($conexao,$usuario['id_usuario']);
?>
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
<div class="home">
  <div class="row">
    <div class="col-xs-4">
      <h3 class="text-left">Seja bem-vindo</h3>
    </div>
    <a href="javascript:void(0);" class="btn btn-default col-xs-2 clock-button"><?php echo date("d/m/Y") ?> <span class="clock"></span> </a>
  </div>


  <div class="row home-container">

    <div class="col-xs-12">
      
        <?php if(!empty($lembretes)){ ?><h4 class="text-left" style="display: inline-block;float: left;">Lembretes</h4><?php } ?>
        <a href="javascript:void(0);" class="btn btn-primary pull-right h2 btn-novo" data-toggle="modal" data-target=".bs-lembrete-modal-lg"><i class="glyphicon glyphicon-plus"></i> Novo Lembrete</a>
     </div>
      <div class="col-xs-12">
        <?php include(dirname(__FILE__)."/home/lembrete.php") ?>
      </div>
    <div class="col-xs-4">
      <h4 class="text-left">Agenda Semanal</h4>
    </div>

    <div class="col-xs-12">
      <?php include(dirname(__FILE__)."/home/agenda_home.php") ?>
    </div>

    <div class="col-xs-6 home-container text-left">
      <h4 class="text-left">Parabéns para você!</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Data de aniversário</th>
            <th>Tipo</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($aniversariantes as $aniversariante){ ?>
          <tr>
            <td><?= utf8_encode($aniversariante['nome']) ?></td>
            <td><?= $aniversariante['data_nascimento'] ?></td>
            <td><?= $aniversariante['tipo'] ?></td>
          </tr>
        <?php  } ?>
        </tbody>
      </table>
    </div>
<!--     <div class="col-xs-5 text-left col-xs-offset-1 home-container">
      <h4 class="text-left">Frase do dia</h4>
      <blockquote class="text-center quote-day">
        <p>
          "<?= utf8_encode($frase);?>"
        </p>
      </blockquote>
    </div> -->
  </div>

</div>


<script src="<?php echo $base_url; ?>/js/home/clock.js"></script>
<script src="<?php echo $base_url; ?>/js/home/calendar.js"></script>

<?php include("rodape.php") ?>