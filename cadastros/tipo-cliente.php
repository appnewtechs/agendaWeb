<?php 
require_once "../bootstrap.php";
require "../cabecalho.php";
?>
<div class="col-xs-12 breadcrumb">
	<span>CADASTROS > TIPO DE CLIENTE</span>
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
					    <a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-tipo-cliente-modal-lg"><i class="glyphicon glyphicon-plus"></i></a>
					</div>
				</div> 
			</div>
			<?php } ?>
			<table class="table table-hover">
			    <thead>
			        <tr>
				        <th>Código</th>
				        <th>Descrição</th>
				        <th>Cliente/Fornecedor</th>
				        <!-- <th>Prestador de Serviço</th> -->
			    	</tr>
			    </thead>
			    <tbody>
					<?php 
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$tiposClientes = ListaTiposClientesPaginado($conexao, $page);
						if($modo==1){
						foreach ($tiposClientes as $tipoCliente){ 
						$tipoCliente['descricao'] = utf8_encode($tipoCliente['descricao']);
						$tipoCliente['cliente_fornecedor'] = utf8_encode($tipoCliente['cliente_fornecedor']);
					?>    
				    <tr data-toggle="modal" data-target=".bs-tipo-cliente-alterar-modal-lg-<?php echo $tipoCliente['id_tipo_cliente']; ?>">
					    <td><?= $tipoCliente['codigo'];?></td>
					    <td><?= $tipoCliente['descricao'];?></td>
					    <td><?= $tipoCliente['cliente_fornecedor'];?></td>
					    <!-- <td><?php if($tipoCliente['prestador_servico']==0){echo "Não";}else{echo "Sim";}?></td> -->
				    </tr>
				    <?php
					}}else{
					foreach ($tiposClientes as $tipoCliente){
						$tipoCliente['descricao'] = utf8_encode($tipoCliente['descricao']);
						$tipoCliente['cliente_fornecedor'] = utf8_encode($tipoCliente['cliente_fornecedor']); 
					?> 
				    <tr>
					    <td><?= $tipoCliente['codigo'];?></td>
					    <td><?= $tipoCliente['descricao'];?></td>
					    <td><?= $tipoCliente['cliente_fornecedor'];?></td>
					    <!-- <td><?php if($tipoCliente['prestador_servico']==0){echo "Não";}else{echo "Sim";}?></td> -->
				    </tr>
					<?php
					}}
					?>
			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL PARA CADASTRO DE NOVO TIPO DE CLIENTE -->
<div class="modal fade bs-tipo-cliente-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Tipo de Cliente</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" action="adiciona-tipo-cliente.php" method="post">		  
										<div class="row">
										    <div class="form-group col-md-2">
										      	<label class="col-form-label required">Codigo</label>
										    	<input type="text" class="form-control inteiro" name="codigo" placeholder="Codigo" required="true" autofocus>
										    </div>
										    <div class="form-group col-md-5">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" name="descricao" placeholder="Descrição" required="true">
										    </div>
										    <div class="form-group col-md-5">
										      	<label class="col-form-label required">Cliente/Fornecedor</label>
												<select class="custom-select form-control" name="cliente_fornecedor">
													<option value="Cliente">Cliente</option>
													<option value="Fornecedor">Fornecedor</option>
													<option value="Cliente/Fornecedor">Cliente/Fornecedor</option>
												</select>
											</div>
										  <!--   <div class="form-group col-md-3 prestador_servico">
										      	<label class="col-form-label">Prestador de serviço</label>
										    	<input type="checkbox" class="form-control" name="prestador_servico" value="1">
										    </div> -->
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

<!-- MODAL PARA ALTERAÇÃO DE TIPO DE CLIENTES -->
<?php foreach ($tiposClientes as $key => $tipoCliente){  
$tipoCliente['descricao'] = utf8_encode($tipoCliente['descricao']);
$tipoCliente['cliente_fornecedor'] = utf8_encode($tipoCliente['cliente_fornecedor']);
?>
<div class="modal fade bs-tipo-cliente-alterar-modal-lg-<?php echo $tipoCliente['id_tipo_cliente']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Tipo de Cliente</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-tipo-cliente.php" method="post">
										<input type="hidden" name="id_tipo_cliente" value="<?= $tipoCliente['id_tipo_cliente']?>"/>
										<div class="row">
											<div class="form-group col-md-2">
										      	<label class="col-form-label required">Codigo</label>
										    	<input class="form-control inteiro" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" value="<?= $tipoCliente['codigo'];?>" type="text" name="codigo" id="codigo" required="true">
											</div>
										    <div class="form-group col-md-5">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" value="<?= $tipoCliente['descricao'];?>" class="form-control" name="descricao" required="true">
										    </div>
										    <div class="form-group col-md-5">
										      	<label class="col-form-label required">Cliente/Fornecedor</label>
												<select class="custom-select form-control" name="cliente_fornecedor">
													<option <?php if ($tipoCliente['cliente_fornecedor'] == "Cliente"){ echo "selected";} ?> value="Cliente">Cliente</option>
													<option <?php if ($tipoCliente['cliente_fornecedor'] == "Fornecedor"){ echo "selected";} ?> value="Fornecedor">Fornecedor</option>
													<option <?php if ($tipoCliente['cliente_fornecedor'] == "Cliente/Fornecedor"){ echo "selected";} ?> value="Cliente/Fornecedor">Cliente/Fornecedor</option>
												</select>
											</div>
										    <!-- <div class="form-group col-md-3 prestador_servico">
										      	<label class="col-form-label">Prestador de serviço</label>
										    	<input type="checkbox" class="form-control" name="prestador_servico" value="1" <?php if ($tipoCliente['prestador_servico'] == "1"){ echo "checked";} ?>>
										    </div> -->
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
							<form action="remove-tipo-cliente.php" method="POST" name="form_exclusao_tipo_cliente">
								<input type="hidden" name="id_tipo_cliente" value="<?= $tipoCliente['id_tipo_cliente']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Tipo de Cliente</button>
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
    $sql = "select count(*) from tipo_cliente";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='tipo-cliente.php?page=".$i."'>".$i."</a></li>";  
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
			hrefTextPrefix : 'tipo-cliente.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>