<?php 
require_once "../bootstrap.php";
require "../cabecalho.php";
?>

<div class="col-xs-12 breadcrumb">
	<span>CADASTROS > LINHA DE PRODUTO</span>
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
					    <a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-linha-produto-modal-lg">
					    	<i class="glyphicon glyphicon-plus"></i>
					    </a>
					</div>
				</div> 
			</div>
			<?php } ?>
			<table class="table table-hover">
			    <thead>
			        <tr>
				        <th>Código</th>
				        <th>Descrição</th>
			    	</tr>
			    </thead>
			    <tbody>
					<?php 
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$linhasProdutos = ListaLinhasProdutosPaginado($conexao, $page);
						if($modo==1){
						foreach ($linhasProdutos as $linhaProduto){ 
						$linhaProduto['codigo'] = utf8_encode($linhaProduto['codigo']);
						$linhaProduto['descricao'] = utf8_encode($linhaProduto['descricao']);

					?>    
				    <tr data-toggle="modal" data-target=".bs-linha-produto-alterar-modal-lg-<?php echo $linhaProduto['id_linha_produto']; ?>">
					    <td><?= $linhaProduto['codigo'];?></td>
					    <td><?= $linhaProduto['descricao'];?></td>
				    </tr>
				    <?php
					}}else{
					foreach ($linhasProdutos as $linhaProduto){ 
					?>   
				    <tr>
					    <td><?= $linhaProduto['codigo'];?></td>
					    <td><?= $linhaProduto['descricao'];?></td>
				    </tr>
					<?php
					}}
					?>
			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL PARA CADASTRO -->
<div class="modal fade bs-linha-produto-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Linha de produto</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" action="adiciona-linha-produto.php" method="post">		  
										<div class="row">
										    <div class="form-group col-md-2">
										      	<label class="col-form-label required">Codigo</label>
										    	<input type="text" class="form-control inteiro" name="codigo" placeholder="Codigo" required="true" autofocus>
										    </div>
										    <div class="form-group col-md-10">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" name="descricao" placeholder="Descrição" required="true">
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

<!-- MODAL PARA ALTERAÇÃO -->
<?php foreach ($linhasProdutos as $key => $linhaProduto){  ?>
<?php 
	$linhaProduto['codigo'] = utf8_encode($linhaProduto['codigo']);
	$linhaProduto['descricao'] = utf8_encode($linhaProduto['descricao']);
 ?>
<div class="modal fade bs-linha-produto-alterar-modal-lg-<?php echo $linhaProduto['id_linha_produto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Alterar Linha de produto</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-linha-produto.php" method="post">		  
										<input type="hidden" name="id_linha_produto" value="<?= $linhaProduto['id_linha_produto']?>"/>
										<div class="row">
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Codigo</label>
										      	<input class="form-control inteiro" value="<?= $linhaProduto['codigo'];?>" type="text" name="codigo" required="true" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
										    </div>
										    <div class="form-group col-md-10">
										      	<label class="col-form-label required">Descrição</label>
										    	<input type="text" class="form-control" value="<?= $linhaProduto['descricao'];?>" name="descricao" required="true">
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
							<form action="remove-linha-produto.php" method="POST" name="form_exclusao_linha_produto">
								<input type="hidden" name="id_linha_produto" value="<?= $linhaProduto['id_linha_produto']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Linha de produto</button>
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
    $sql = "select count(*) from linha_produto";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='linha-produto.php?page=".$i."'>".$i."</a></li>";  
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
			hrefTextPrefix : 'linha-produto.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>