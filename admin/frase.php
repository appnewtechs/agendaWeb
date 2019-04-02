<?php require_once("../cabecalho.php") ?>
<?php require_once("../banco-usuario.php") ?>

<div class="col-xs-12 breadcrumb">
	<span>ADMIN > FRASES DO DIA</span>
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
$id = searchForId('1', $_SESSION["permissoesRotina"]);
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
					    <a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-frase-modal-lg"><i class="glyphicon glyphicon-plus"></i></a>
					</div>
				</div> 
			</div>
						<?php } ?>
			<table class="table table-hover">
			    <thead>
			        <tr>
				        <th>Código</th>
				        <th>Descrição</th>
				        <th>Usado</th>
			    	</tr>
			    </thead>
			    <tbody>
					<?php 
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$frases = ListaFrasesPaginado($conexao, $page);
						if($modo==1){
						foreach ($frases as $frase){ 
							$frase['descricao'] = utf8_encode($frase['descricao']);
					?>    
				    <tr data-toggle="modal" data-target=".bs-frase-alterar-modal-lg-<?php echo $frase['id_frase']; ?>">
					    <td><?= $frase['id_frase'];?></td>
					    <td><?= $frase['descricao'];?></td>
					    <td><?php if($frase['usado']==1){echo "Sim";}else{echo "Não";} ?></td>
				    </tr>
				    <?php
					}}else{
					foreach ($frases as $frase){
						$frase['descricao'] = utf8_encode($frase['descricao']); 
					?> 
				    <tr>
					    <td><?= $frase['id_frase'];?></td>
					    <td><?= $frase['descricao'];?></td>
					    <td><?php if($frase['usado']==1){echo "Sim";}else{echo "Não";} ?></td>
				    </tr>
					<?php
					}}
					?>
			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL PARA CADASTRO DE NOVA FRASE -->
<div class="modal fade bs-frase-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Nova Frase</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" action="adiciona-frase.php" method="post">		  
										<div class="row">
										    <div class="form-group col-md-12">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" name="descricao" placeholder="Descrição" required="true" autofocus>
										    </div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-success" name="botaoEnviar" name="botaoEnviar">Salvar</button>
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

<!-- MODAL PARA ALTERAÇÃO DE FRASE -->
<?php foreach ($frases as $key => $frase){  
		$descricao = utf8_encode($frase['descricao']);	?>
<div class="modal fade bs-frase-alterar-modal-lg-<?php echo $frase['id_frase']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Nova Frase</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-frase.php" method="post">		  
										<input type="hidden" name="id_frase" value="<?= $frase['id_frase']?>"/>
										<div class="row">
										    <div class="form-group col-md-3">
										      	<label class="col-form-label">Codigo</label>
										      	<input disabled class="form-control" value="<?= $frase['id_frase'];?>" type="text" name="id_frase" id="id_frase" required="true">
										    </div>
										    <div class="form-group col-md-9">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" value="<?= $descricao;?>" name="descricao" required="true" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
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
							<form action="remove-frase.php" method="POST" name="form_exclusao_frase">
								<input type="hidden" name="id_frase" value="<?= $frase['id_frase']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Frase</button>
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
    $sql = "select count(*) from frase";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='frase.php?page=".$i."'>".$i."</a></li>";  
    };  
    echo $pagLink . "</ul></nav>";  
    ?>
<script>
	$(document).ready(function(){
		$('.pre-selected-options').multiSelect();
		$('.pagination').pagination({
			items: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page; ?>,
			hrefTextPrefix : 'frase.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>