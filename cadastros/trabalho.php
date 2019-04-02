<?php require_once("../cabecalho.php") ?>
<?php require_once("../banco-cadastros.php") ?>

<div class="col-xs-12 breadcrumb">
	<span>CADASTROS > TIPO DE TRABALHO</span>
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

function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['id_rotina'] === $id) {
           return $val['edicao'];
       }
   }
   return null;
}
$id = searchForId('2', $_SESSION["permissoesRotina"]);
$modo = $id;
?>

<!-- LISTA DADOS JÁ INCLUSOS NO BANCO -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
	<div class="panel-body">
		<div class="tab-content">
			<?php if($modo==1){ ?>
			<div id="cadastros" class="tab-pane fade in active">
				<div id="top" class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">					        
					    <a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-trabalho-modal-lg">
					    	<i class="glyphicon glyphicon-plus"></i>
					    </a>
					</div>
				</div> 
			</div>
			<?php } ?>
			<table class="table table-hover default">
			    <thead>
			        <tr>
				        <th>Código</th>
				        <th>Descrição</th>
				        <th>Cor</th>
			    	</tr>
			    </thead>
			    <tbody>
					<?php 
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$trabalhos = ListaTrabalhosPaginado($conexao, $page);
						if($modo==1){
						foreach ($trabalhos as $trabalho){ 
							$trabalho['descricao'] = utf8_encode($trabalho['descricao']);
					?>    
				    <tr data-toggle="modal" data-target=".bs-trabalho-alterar-modal-lg-<?php echo $trabalho['id_trabalho']; ?>">
					    <td><?= $trabalho['codigo'];?></td>
					    <td><?= $trabalho['descricao'];?></td>
					    <td><div style="border:1px solid <?= $trabalho['cor']; ?>;background-color:<?= $trabalho['cor']; ?>;padding:10px;"></div></td>
				    </tr>
					<?php
					}}else{
					foreach ($trabalhos as $trabalho){ 
							$trabalho['descricao'] = utf8_encode($trabalho['descricao']);
					?>    
				    <tr>
					    <td><?= $trabalho['codigo'];?></td>
					    <td><?= $trabalho['descricao'];?></td>
					    <td><div style="border:1px solid <?= $trabalho['cor']; ?>;background-color:<?= $trabalho['cor']; ?>;padding:10px;"></div></td>
				    </tr>
					<?php
					}}?>
			    </tbody>
			</table>
			<table class="table table-hover busca">
				<thead>
			        <tr>
				        <th>Código</th>
				        <th>Descrição</th>
			    	</tr>
			    </thead>
			    <tbody class="insert">
					
			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL PARA CADASTRO DE NOVO TRABALHO -->
<div class="modal fade bs-trabalho-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Trabalho</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" action="adiciona-trabalho.php" method="post">		  
										<div class="row">
											<div class="form-group col-md-2">
												<label class="col-form-label required">Código</label>
										    	<input type="text" class="form-control inteiro" name="codigo" placeholder="Código" required="true" autofocus>
											</div>
										    <div class="form-group col-md-8">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" name="descricao" placeholder="Descrição" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Cor do Usuário</label>
										      	<input name="cor" class="jscolor form-control" value="0071c5">
										    </div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-success" name="botaoEnviar">Salvar</button>
												</div>
											</div>
										</div>
									</form>	
								</div>		
							</div>	
						</div>	
					</div>
				</div>			
			</div>	
		</div>
	</div>
</div>

<!-- MODAL PARA ALTERAÇÃO DE TRABALHO -->
<?php foreach ($trabalhos as $key => $trabalho){
$trabalho['descricao'] = utf8_encode($trabalho['descricao']);
?>
<div class="modal fade bs-trabalho-alterar-modal-lg-<?php echo $trabalho['id_trabalho']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Alterar Trabalho</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-trabalho.php" method="post">		  
										<input type="hidden" name="id_trabalho" value="<?= $trabalho['id_trabalho']?>"/>
										<div class="row">
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Codigo</label>
										      	<input class="form-control inteiro" value="<?= $trabalho['codigo'];?>" type="text" name="codigo" id="codigo" required="true" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
										    </div>
										    <div class="form-group col-md-8">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" value='<?= $trabalho["descricao"];?>' name="descricao" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Cor do Usuário</label>
										      	<input name="cor" class="jscolor form-control" value="<?= $trabalho['cor'];?>">
										    </div>
										</div>			
										<div class="row">
											<div class="form-group col-md-12">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-success" name="botaoEnviar">Salvar</button>
												</div>
											</div>
										</div>
									</form>	
								</div>		
							</div>	
							<form action="remove-trabalho.php" method="POST" name="form_exclusao_trabalho">
								<input type="hidden" name="id_trabalho" value="<?= $trabalho['id_trabalho']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Trabalho</button>
							</form>
						</div>	
					</div>
				</div>			
			</div>	
		</div>
	</div>
</div>

<?php } ?>

<?php  
	$limit = 10;
    $sql = "select count(*) from trabalho";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='trabalho.php?page=".$i."'>".$i."</a></li>";  
    };  
    echo $pagLink . "</ul></nav>";  
    ?>
<script src="<?php echo $base_url; ?>/js/custom.js"></script>
<script src="<?php echo $base_url; ?>/js/jscolor.js"></script>
<script>
	$(document).ready(function(){
		
		$('.pre-selected-options').multiSelect();
		$('.pagination').pagination({
			items: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page; ?>,
			hrefTextPrefix : 'trabalho.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>