<?php require_once("../cabecalho.php") ?>
<?php require_once("../banco-cadastros.php") ?>

<div class="col-xs-12 breadcrumb">
	<span>CADASTROS > CONTATO</span>
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
$clientes = buscaClientesNome($conexao);
?>

<!-- LISTA DADOS JÁ INCLUSOS NO BANCO -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
	<div class="panel-body">
		<div class="tab-content">
			<div id="cadastros" class="tab-pane fade in active">
				<div id="top" class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-pages">	
			<?php if($modo==1){ ?>
						<div class="form-group col-xs-6">
							<a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-contato-modal-lg">
								<i class="glyphicon glyphicon-plus"></i>
							</a>
						</div>	
						<?php } ?>			        				    	
						<!-- <div class="form-group col-xs-6">
					    	<div class="inner-addon right-addon">
						    	<i class="glyphicon glyphicon-search"></i>
						      	<input type="text" class="form-control" id="busca" placeholder="Informe o contato..." />
						    </div>
						</div>		 -->		        
						<input type="hidden" name="tabela" id="tabela" value="contato"/>
						<input type="hidden" name="modo" id="modo" value="<?=$modo?>"/>
						<input type="hidden" name="like" id="like" value="id_contato,nome"/>
						<input type="hidden" name="campos" id="campos" value="id_contato,nome,telefone,area_contato,email,nome_fantasia"/>
					</div>
				</div> 
			</div>
			<table class="table table-hover default">
			    <thead>
			        <tr>
				        <th>Nome</th>
				        <th>Telefone</th>
				        <th>Área</th>
				        <th>E-mail</th>
				        <th>Cliente</th>
			    	</tr>
			    </thead>
			    <tbody>
					<?php 
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$contatos = ListaContatosPaginado($conexao, $page);
						if($modo==1){
						foreach ($contatos as $contato){ 
							$contato['nome'] = utf8_encode($contato['nome']);
							$contato['area_contato'] = utf8_encode($contato['area_contato']);
							$contato['nome_fantasia'] = utf8_encode($contato['nome_fantasia']);
					?>    
				    <tr data-toggle="modal" data-target=".bs-contato-alterar-modal-lg-<?php echo $contato['id_contato']; ?>">
					   
					    <td><?= $contato['nome'];?></td>
					    <td><?= $contato['telefone'];?></td>
					    <td><?= $contato['area_contato'];?></td>
					    <td><?= $contato['email'];?></td>
					    <td><?= $contato['nome_fantasia'];?></td>
				    </tr>
				    <?php
					}}else{
					foreach ($contatos as $contato){
							$contato['nome'] = utf8_encode($contato['nome']);
							$contato['area_contato'] = utf8_encode($contato['area_contato']);
							$contato['nome_fantasia'] = utf8_encode($contato['nome_fantasia']); 
					?>    
				    <tr>
					  
					    <td><?= $contato['nome'];?></td>
					    <td><?= $contato['telefone'];?></td>
					    <td><?= $contato['area_contato'];?></td>
					    <td><?= $contato['email'];?></td>
					    <td><?= $contato['nome_fantasia'];?></td>
				    </tr>
					<?php
					}}
					?>
			    </tbody>
			</table>
			<table class="table table-hover busca">
				<thead>
			        <tr>
			        
				        <th>Nome</th>
				        <th>Telefone</th>
				        <th>Área</th>
				        <th>E-mail</th>
				        <th>Cliente</th>
			    	</tr>
			    </thead>
			    <tbody class="insert">
					
			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL PARA CADASTRO DE NOVO TRABALHO -->
<div class="modal fade bs-contato-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Contato</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" action="adiciona-contato.php" method="post">		  
										<div class="row">
										    <!-- <div class="form-group col-md-4">
										      	<label class="col-form-label required">Cliente</label>
										    	<input class="form-control" type="text" name="autocompleteCliente" id="autocompleteCliente" placeholder="Informe o cliente..." required="true" autofocus>
												<input type="hidden" id="id_cliente" name="id_cliente"/>
										    </div> -->
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Cliente</label>
										      	<select name="id_cliente" class="custom-select form-control" required="true">
												<?php 
												  	foreach ($clientes as $key => $cliente) {
														echo "<option value='".$cliente['id_cliente']."'>".utf8_encode($cliente['nome_fantasia'])."</option>";
												  	}
												?>
												</select>
											</div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Nome</label>
										    	<input type="text" class="form-control" name="nome" placeholder="Nome" required="true">
										    </div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label">Data de Nascimento</label>
										    	<input class="form-control data_nascimento" name="data_nascimento">
										    </div>
										</div>
										<div class="row">
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Telefone</label>
										    	<input type="text" class="form-control phone_with_ddd" name="telefone" placeholder="Telefone" required="true">
										    </div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label">Telefone 2</label>
										    	<input type="text" class="form-control phone_with_ddd" name="telefone2" placeholder="Telefone 2">
										    </div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label">Telefone 3</label>
										    	<input type="text" class="form-control phone_with_ddd" name="telefone3" placeholder="Telefone 3">
										    </div>
										</div>
										<div class="row">
										    <div class="form-group col-md-6">
										      	<label class="col-form-label">E-mail</label>
										    	<input type="email" class="form-control" name="email" placeholder="E-mail">
										    </div>
										    <div class="form-group col-md-6">
										      	<label class="col-form-label">Área do Contato</label>
										    	<input type="text" class="form-control" name="area_contato" placeholder="Área">
										    </div>
										</div>
										<div class="row">
										    <div class="form-group col-md-12">
										      	<label class="col-form-label">Observação</label>
										    	<textarea type="text" class="form-control" name="observacao" placeholder="Observação"></textarea>
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
<?php foreach ($contatos as $key => $contato){  
$contato['nome'] = utf8_encode($contato['nome']);
$contato['area_contato'] = utf8_encode($contato['area_contato']);
$contato['observacao'] = utf8_encode($contato['observacao']);
?>
<div class="modal fade bs-contato-alterar-modal-lg-<?php echo $contato['id_contato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Alterar Contato</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-contato.php" method="post">		 
										<input type="hidden" name="id_contato" value="<?= $contato['id_contato']?>"/>										
										<div class="row">
										    <!-- <div class="form-group col-md-4">
										      	<label class="col-form-label required">Cliente</label>
										    	<input class="form-control" value="<?= $contato['nome_fantasia'];?>" disabled type="text" name="nome_fantasia" required="true">
										    </div> -->
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Cliente</label>
										      	<select name="id_cliente" class="custom-select form-control" required="true">
												<?php 
												  	foreach ($clientes as $key => $cliente) {
														if($contato['id_cliente']==$cliente['id_cliente']){
															echo "<option value='".$cliente['id_cliente']."' selected>".utf8_encode($cliente['nome_fantasia'])."</option>";
														}else{
															echo "<option value='".$cliente['id_cliente']."'>".utf8_encode($cliente['nome_fantasia'])."</option>";
														}
												  	}
												?>
												</select>
											</div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Nome</label>
										    	<input type="text" class="form-control" value="<?= $contato['nome'];?>" name="nome" placeholder="Nome" required="true" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
										    </div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label">Data de Nascimento</label>
										      	<?php $data_nascimento = ""; if($contato['data_nascimento'] != ""){$data_nascimento = date('d/m/Y', strtotime($contato['data_nascimento'])); } ?>
										    	<input type="text" class="form-control data_nascimento" name="data_nascimento" value="<?= $data_nascimento ?>">
										    </div>
										</div>
										<div class="row">
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Telefone</label>
										    	<input type="text" class="form-control phone_with_ddd required" value="<?= $contato['telefone'];?>" name="telefone" placeholder="Telefone" required="true">
										    </div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label">Telefone 2</label>
										    	<input type="text" class="form-control phone_with_ddd" value="<?= $contato['telefone2'];?>" name="telefone2" placeholder="Telefone 2">
										    </div>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label">Telefone 3</label>
										    	<input type="text" class="form-control phone_with_ddd" value="<?= $contato['telefone3'];?>" name="telefone3" placeholder="Telefone 3">
										    </div>
										</div>
										<div class="row">
										    <div class="form-group col-md-6">
										      	<label class="col-form-label">E-mail</label>
										    	<input type="email" class="form-control" value="<?= $contato['email'];?>" name="email" placeholder="E-mail">
										    </div>
										    <div class="form-group col-md-6">
										      	<label class="col-form-label">Área do Contato</label>
										    	<input type="text" class="form-control" value="<?= $contato['area_contato'];?>" name="area_contato" placeholder="Área">
										    </div>
										</div>
										<div class="row">
										    <div class="form-group col-md-12">
										      	<label class="col-form-label">Observação</label>
										    	<textarea type="text" class="form-control" value="<?= $contato['observacao'];?>" name="observacao" placeholder="Observação"><?= $contato['observacao'];?></textarea>
										    </div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-success">Salvar</button>
												</div>
											</div>
										</div>
									</form>	
								</div>		
							</div>	
							<form action="remove-contato.php" method="POST" name="form_exclusao_contato">
								<input type="hidden" name="id_contato" value="<?= $contato['id_contato']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Contato</button>
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
    $sql = "select count(*) from contato";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='contato.php?page=".$i."'>".$i."</a></li>";  
    };  
    echo $pagLink . "</ul></nav>";  
?>
<script src="<?php echo $base_url; ?>/js/custom.js"></script><!-- 
<script src="<?php echo $base_url; ?>/js/consultaCliente.js"></script> -->
<script>

// $('.data_nascimento').datepick({});
	$(document).ready(function(){
  		// $('.date').mask('00/00/0000');
  		// $('.phone_with_ddd').mask('(00) 00000-0000');
  		// $('.data_nascimento').mask('00/00/0000');
  		$('.data_nascimento').datepick({onSelect: function (){this.focus();}});
  		// $('#autocompleteCliente').keyup(function() {
  		// 	$('#id_cliente').val('');
  		// });
  	});
	$(document).ready(function(){
		$('.pre-selected-options').multiSelect();
		$('.pagination').pagination({
			items: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page; ?>,
			hrefTextPrefix : 'contato.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});

</script>
<?php include("../rodape.php") ?>