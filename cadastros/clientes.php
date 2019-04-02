<?php require_once("../cabecalho.php") ?>
<?php require_once("../banco-financeiro.php") ?>
<?php require_once("../funcoes.php") ?>

<div class="col-xs-12 breadcrumb">
	<span>CADASTROS > CLIENTE</span>
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="float: none;">
	<div class="panel-body">
		<div class="tab-content">
			<div id="cadastros" class="tab-pane fade in active">
				<div id="top" class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-pages">	
						<?php if($modo==1){ ?>
						<div class="form-group col-xs-6">
							<a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" onclick="abrirpopup('../cadastros/cliente.php?acao=1&id_cliente=0','Cliente');">
						    	<i class="glyphicon glyphicon-plus"></i>
							</a>
						</div>				        				    	
						<?php } ?>
						<div class="form-group col-xs-6">
					    	<div class="inner-addon right-addon">
						    	<i class="glyphicon glyphicon-search"></i>
						      	<input type="text" class="form-control" id="busca" placeholder="Informe o cliente..." />
						    </div>
						</div>				        
						<input type="hidden" name="tabela" id="tabela" value="cliente"/>
						<input type="hidden" name="modo" id="modo" value="<?=$modo?>"/>
						<input type="hidden" name="like" id="like" value="id_cliente,razao_social,nome_fantasia,cnpj"/>
						<input type="hidden" name="campos" id="campos" value="razao_social,nome_fantasia,telefone_fixo"/>
					</div>
				</div> 
			</div>
			<table class="table table-hover default tablesorter">
			    <thead>
			        <tr>
				        <!-- <th>Código</th> -->
				        <th>Razão Social</th>
				        <th>Nome Fantasia</th>
				        <th>CNPJ/CPF</th>
				        <th>Telefone</th>
			    	</tr>
			    </thead>
			    <tbody>
					<?php 
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$clientes = ListaClientesPaginado($conexao, $page);
						if($modo==1){
						foreach ($clientes as $cliente){ 
						$cliente['razao_social'] = utf8_encode($cliente['razao_social']);
						$cliente['nome_fantasia'] = utf8_encode($cliente['nome_fantasia']);
					?>   
					<tr style="cursor: pointer;" onclick="abrirpopup('../cadastros/cliente.php?acao=2&id_cliente=<?php echo $cliente['id_cliente']; ?>','Cliente');">
					    <!-- <td><?= $cliente['id_cliente'];?></td> -->
					    <td><?= $cliente['razao_social'];?></td>
					    <td><?= $cliente['nome_fantasia'];?></td>
					    <td><?php if($cliente['cnpj']!=""){echo $cliente['cnpj'];}else if($cliente['cpf']!=""){echo $cliente['cpf'];} ?></td>
					    <td><?= $cliente['telefone_fixo'];?></td>
				    </tr>
				    <?php
					}}else{
					foreach ($clientes as $cliente){ 
						$cliente['razao_social'] = utf8_encode($cliente['razao_social']);
						$cliente['nome_fantasia'] = utf8_encode($cliente['nome_fantasia']);
					?>  
				    <tr>
					    <!-- <td><?= $cliente['id_cliente'];?></td> -->
					    <td><?= $cliente['razao_social'];?></td>
					    <td><?= $cliente['nome_fantasia'];?></td>
					    <td><?php if($cliente['cnpj']!=""){echo $cliente['cnpj'];}else if($cliente['cpf']!=""){echo $cliente['cpf'];} ?></td>
					    <td><?= $cliente['telefone_fixo'];?></td>
				    </tr>
					<?php
					}}
					?>
			    </tbody>
			</table>
			<table class="table table-hover busca">
				<thead>
			        <tr>
				        <!-- <th>Código</th> -->
				        <th>Razão Social</th>
				        <th>Nome Fantasia</th>
				        <!-- <th>CNPJ</th> -->
				        <th>Telefone</th>
			    	</tr>
			    </thead>
			    <tbody class="insert">
					
			    </tbody>
			</table>
		
		</div>
	</div>
</div>
<div>  </div>


<?php
	$limit = 30;
    $sql = "select count(*) from cliente";
    $rs_result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
    $pagLink = "<nav><ul class='pagination'>";
    for ($i=1; $i<=$total_pages; $i++) {
                 $pagLink .= "<li><a href='clientes.php?page=".$i."'>".$i."</a></li>";
    };
    echo $pagLink . "</ul></nav>";
    ?>
<!-- <script src="<?php echo $base_url; ?>/js/custom.js"></script> -->
<script>
	$(document).ready(function(){
		$('.pre-selected-options').multiSelect();
		$('.pagination').pagination({
			items: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page; ?>,
			hrefTextPrefix : 'clientes.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>