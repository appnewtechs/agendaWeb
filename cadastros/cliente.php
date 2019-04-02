<?php require_once("../cabecalho.php") ?>
<?php require_once("../banco-cadastros.php") ?>

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

$usuarios = buscaUsuariosNome($conexao);
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
							<a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-cliente-modal-lg">
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
			<table class="table table-hover default">
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
				    <tr data-toggle="modal" data-target=".bs-cliente-alterar-modal-lg-<?php echo $cliente['id_cliente']; ?>">
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

<!-- MODAL PARA CADASTRO DE NOVO TRABALHO -->
<div class="modal fade bs-cliente-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Cliente</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<ul class="nav nav-tabs">
									    <li class="active"><a data-toggle="tab" href="#menu1">Dados Gerais</a></li>
									    <li><a data-toggle="tab" href="#menu2">Financeiro</a></li>
								  	</ul>
									<form class="form-horizontal formulario0" action="adiciona-cliente.php" method="post">
										<div class="tab-content">
	    									<div id="menu1" class="tab-pane fade in active">		  
												<div class="row">
													<?php 
														$tipos_cliente = buscaTiposCliente($conexao);
														$trabalhos_prestado = buscaTrabalhos($conexao);
													?>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Tipo de Cliente</label>
												     	<select name="tipo_cliente" class="custom-select form-control" required="true">
														<?php 
														  	foreach ($tipos_cliente as $key => $tipo_cliente) {
																echo "<option value='".$tipo_cliente['id_tipo_cliente']."'>".utf8_encode($tipo_cliente['descricao'])."</option>";
														  	}
														?>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Prestador de Serv.</label>
												    	<select name="prestador_servico" class="custom-select form-control" required="true">
															<option value='1'>Sim</option>
															<option value='0'>Não</option>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Trabalho Prestado</label>
												    	<select name="trabalho_prestado" class="custom-select form-control" required="true">
												    	<?php 
														  	foreach ($trabalhos_prestado as $key => $trabalho_prestado) {
																echo "<option value='".$trabalho_prestado['id_trabalho']."'>".utf8_encode($trabalho_prestado['descricao'])."</option>";
														  	}
														?>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Data de Nascimento</label>
												    	<input type="text" class="form-control data_nascimento" name="data_nascimento" placeholder="Data de Nascimento">
												    </div>
												</div>
												<div class="row">
												    <div class="form-group col-md-4">
												      	<label class="col-form-label required">Razão Social</label>
												     	<input type="text" class="form-control" name="razao_social" placeholder="Razão Social" required="true">
												    </div>
												    <div class="form-group col-md-4">
												      	<label class="col-form-label required">Nome Fantasia</label>
												    	<input type="text" class="form-control" name="nome_fantasia" placeholder="Nome Fantasia" required="true">
												    </div>
												    <div class="form-group col-md-4">
												      	<label class="col-form-label">E-mail</label>
												    	<input type="text" class="form-control email" name="email" placeholder="email" >
												    </div>
												</div>
												<div class="row">
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CPF</label>
												     	<input type="text" class="form-control cpf" name="cpf" placeholder="CPF">
												    </div>

												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CNPJ</label>
												    	<input type="text" class="form-control cnpj" name="cnpj" placeholder="CNPJ" autofocus>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">RG</label>
												    	<input type="text" class="form-control rg" name="rg" placeholder="RG">
												    </div>
												    
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Endereço</label>
												    	<input type="text" class="form-control" name="endereco" placeholder="Endereço">
												    </div>
												</div>		  
												<div class="row">
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CEP</label>
												     	<input type="text" class="form-control cep" name="cep" placeholder="CEP">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Estado</label>
												    	<select name="estado" class="custom-select form-control">
															<option value="AC">Acre</option>
															<option value="AL">Alagoas</option>
															<option value="AP">Amapá</option>
															<option value="AM">Amazonas</option>
															<option value="BA">Bahia</option>
															<option value="CE">Ceará</option>
															<option value="DF">Distrito Federal</option>
															<option value="ES">Espírito Santo</option>
															<option value="GO">Goiás</option>
															<option value="MA">Maranhão</option>
															<option value="MT">Mato Grosso</option>
															<option value="MS">Mato Grosso do Sul</option>
															<option value="MG">Minas Gerais</option>
															<option value="PA">Pará</option>
															<option value="PB">Paraíba</option>
															<option value="PR">Paraná</option>
															<option value="PE">Pernambuco</option>
															<option value="PI">Piauí</option>
															<option value="RJ">Rio de Janeiro</option>
															<option value="RN">Rio Grande do Norte</option>
															<option value="RS">Rio Grande do Sul</option>
															<option value="RO">Rondônia</option>
															<option value="RR">Roraima</option>
															<option value="SC">Santa Catarina</option>
															<option value="SP" selected>São Paulo</option>
															<option value="SE">Sergipe</option>
															<option value="TO">Tocantins</option>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Município</label>
												    	<input type="text" class="form-control" name="municipio" placeholder="Município">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Complemento</label>
												    	<input type="text" class="form-control" name="complemento" placeholder="Complemento">
												    </div>
												</div>
												<div class="row">
													<div class="form-group col-md-3">
												      	<label class="col-form-label required">Telefone Fixo</label>
												    	<input type="text" class="form-control phone_with_ddd" name="telefone_fixo" placeholder="Telefone" required="true">
												    </div>
													<div class="form-group col-md-3">
												      	<label class="col-form-label">Telefone Celular</label>
												    	<input type="text" class="form-control phone_with_ddd" name="telefone_celular" placeholder="Telefone">
												    </div>
													<div class="form-group col-md-6">
												      	<label class="col-form-label">Usuário</label>
												      	<select name="id_usuario" class="custom-select form-control">
														<?php 
														  	foreach ($usuarios as $key => $usuario) {
																echo "<option value='".$usuario['id_usuario']."'>".utf8_encode($usuario['nome'])."</option>";
														  	}
														?>
														</select>
													</div>
												</div>
												<div class="row">	
													<div class="form-group col-md-6">
												      	<label class="col-form-label">Observação</label>
												    	<textarea class="form-control" name="observacao" placeholder="Observação"></textarea>
												    </div>
												</div>
											</div>
	    									<div id="menu2" class="tab-pane fade">
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 1</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" name="banco" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" name="agencia" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" name="conta" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" name="descricao" placeholder="Descrição"></textarea>
												    </div>
												</div>
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 2</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" name="banco_2" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" name="agencia_2" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" name="conta_2" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" name="descricao_2" placeholder="Descrição"></textarea>
												    </div>
												</div>
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 3</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" name="banco_3" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" name="agencia_3" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" name="conta_3" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" name="descricao_3" placeholder="Descrição"></textarea>
												    </div>
												</div>
	    									</div>
	    									<div class="row">
												<div class="form-group col-md-12">
													<div class="modal-footer">
														<button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button type="submit" class="btn btn-success" name="botaoEnviar">Salvar</button>
													</div>
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
<?php foreach ($clientes as $key => $cliente){ 
$cliente['razao_social'] = utf8_encode($cliente['razao_social']);
$cliente['nome_fantasia'] = utf8_encode($cliente['nome_fantasia']);
$cliente['endereco'] = utf8_encode($cliente['endereco']);
$cliente['estado'] = utf8_encode($cliente['estado']);
$cliente['municipio'] = utf8_encode($cliente['municipio']);
$cliente['complemento'] = utf8_encode($cliente['complemento']);
$cliente['observacao'] = utf8_encode($cliente['observacao']);
$cliente['banco'] = utf8_encode($cliente['banco']);
$cliente['descricao'] = utf8_encode($cliente['descricao']);
$cliente['banco_2'] = utf8_encode($cliente['banco_2']);
$cliente['descricao_2'] = utf8_encode($cliente['descricao_2']);
$cliente['banco_3'] = utf8_encode($cliente['banco_3']);
$cliente['descricao_3'] = utf8_encode($cliente['descricao_3']);
$cliente['rg'] = utf8_encode($cliente['rg']);
$cliente['email'] = utf8_encode($cliente['email']);
 ?>
<div class="modal fade bs-cliente-alterar-modal-lg-<?php echo $cliente['id_cliente']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Alterar Cliente</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">		  
									<ul class="nav nav-tabs">
									    <li class="active"><a data-toggle="tab" href="#menu1-<?php echo $cliente['id_cliente']; ?>">Dados Gerais</a></li>
									    <li><a data-toggle="tab" href="#menu2-<?php echo $cliente['id_cliente']; ?>">Financeiro</a></li>
									    <li><a data-toggle="tab" href="#menu3-<?php echo $cliente['id_cliente']; ?>">Contatos</a></li>
								  	</ul>
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-cliente.php" method="post">
										<input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente']?>"/>
										<div class="tab-content">
	    									<div id="menu1-<?php echo $cliente['id_cliente']; ?>" class="tab-pane fade in active">		  
												<div class="row">
													<?php 
														$tipos_cliente = buscaTiposCliente($conexao);
														$trabalhos_prestado = buscaTrabalhos($conexao);
													?>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Tipo de Cliente</label>
												     	<select name="tipo_cliente" class="custom-select form-control" required="true">
														<?php 
														  	foreach ($tipos_cliente as $key => $tipo_cliente) {
																if($tipo_cliente['id_tipo_cliente']==$cliente['id_tipo_cliente']){
																	echo "<option value='".$tipo_cliente['id_tipo_cliente']."' selected>".utf8_encode($tipo_cliente['descricao'])."</option>";
																}else{
																	echo "<option value='".$tipo_cliente['id_tipo_cliente']."'>".utf8_encode($tipo_cliente['descricao'])."</option>";
																}
														  	}
														?>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Prestador de Serv.</label>
												    	<select name="prestador_servico" class="custom-select form-control" required="true">
															<option <?php if ($cliente['prestador_servico'] == "1"){ echo "selected";} ?> value='1'>Sim</option>
															<option <?php if ($cliente['prestador_servico'] == "0"){ echo "selected";} ?> value='0'>Não</option>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Trabalho Prestado</label>
												    	<select name="trabalho_prestado" class="custom-select form-control" required="true">
												    	<?php 
														  	foreach ($trabalhos_prestado as $key => $trabalho_prestado) {
																if($trabalho_prestado['id_trabalho']==$cliente['id_trabalho']){
																	echo "<option value='".$trabalho_prestado['id_trabalho']."' selected>".utf8_encode($trabalho_prestado['descricao'])."</option>";
																}else{
																	echo "<option value='".$trabalho_prestado['id_trabalho']."'>".utf8_encode($trabalho_prestado['descricao'])."</option>";
																}
														  	}
														?>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Data de Nascimento</label>
												      	<?php $data_nascimento = ""; if($cliente['data_nascimento'] != ""){$data_nascimento = date('d/m/Y', strtotime($cliente['data_nascimento'])); } ?>
										    			<input type="text" class="form-control data_nascimento" name="data_nascimento" value="<?= $data_nascimento ?>">
												    </div>
												</div>
												<div class="row">
												    <div class="form-group col-md-4">
												      	<label class="col-form-label required">Razão Social</label>
												     	<input type="text" class="form-control" value="<?= $cliente['razao_social']?>" name="razao_social" placeholder="Razão Social" required="true">
												    </div>
												    <div class="form-group col-md-4">
												      	<label class="col-form-label required">Nome Fantasia</label>
												    	<input type="text" class="form-control" value="<?= $cliente['nome_fantasia']?>" name="nome_fantasia" placeholder="Nome Fantasia" required="true">
												    </div>
												    <div class="form-group col-md-4">
												      	<label class="col-form-label">E-mail</label>
												    	<input type="text" class="form-control email" value="<?= $cliente['email']?>" name="email" placeholder="email">
												    </div>
												</div>
												<div class="row">
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CPF</label>
												     	<input type="text" class="form-control cpf" value="<?= $cliente['cpf']?>" name="cpf" placeholder="CPF">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CNPJ</label>
												    	<input type="text" class="form-control cnpj" value="<?= $cliente['cnpj']?>" name="cnpj" placeholder="CNPJ">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">RG</label>
												    	<input type="text" class="form-control rg" value="<?= $cliente['rg']?>" name="rg" placeholder="RG">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Endereço</label>
												    	<input type="text" class="form-control" value="<?= $cliente['endereco']?>" name="endereco" placeholder="Endereço">
												    </div>
												</div>		  
												<div class="row">
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CEP</label>
												     	<input type="text" class="form-control cep" value="<?= $cliente['cep']?>" name="cep" placeholder="CEP">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Estado</label>
														<select name="estado" class="custom-select form-control">
															<option <?php if ($cliente['estado'] == "AC"){ echo "selected";} ?> value="AC">Acre</option>
															<option <?php if ($cliente['estado'] == "AL"){ echo "selected";} ?> value="AL">Alagoas</option>
															<option <?php if ($cliente['estado'] == "AP"){ echo "selected";} ?> value="AP">Amapá</option>
															<option <?php if ($cliente['estado'] == "AM"){ echo "selected";} ?> value="AM">Amazonas</option>
															<option <?php if ($cliente['estado'] == "BA"){ echo "selected";} ?> value="BA">Bahia</option>
															<option <?php if ($cliente['estado'] == "CE"){ echo "selected";} ?> value="CE">Ceará</option>
															<option <?php if ($cliente['estado'] == "DF"){ echo "selected";} ?> value="DF">Distrito Federal</option>
															<option <?php if ($cliente['estado'] == "ES"){ echo "selected";} ?> value="ES">Espirito Santo</option>
															<option <?php if ($cliente['estado'] == "GO"){ echo "selected";} ?> value="GO">Goiás</option>
															<option <?php if ($cliente['estado'] == "MA"){ echo "selected";} ?> value="MA">Maranhão</option>
															<option <?php if ($cliente['estado'] == "MS"){ echo "selected";} ?> value="MS">Mato Grosso do Sul</option>
															<option <?php if ($cliente['estado'] == "MT"){ echo "selected";} ?> value="MT">Mato Grosso</option>
															<option <?php if ($cliente['estado'] == "MG"){ echo "selected";} ?> value="MG">Minas Gerais</option>
															<option <?php if ($cliente['estado'] == "PA"){ echo "selected";} ?> value="PA">Pará</option>
															<option <?php if ($cliente['estado'] == "PB"){ echo "selected";} ?> value="PB">Paraíba</option>
															<option <?php if ($cliente['estado'] == "PR"){ echo "selected";} ?> value="PR">Paraná</option>
															<option <?php if ($cliente['estado'] == "PE"){ echo "selected";} ?> value="PE">Pernambuco</option>
															<option <?php if ($cliente['estado'] == "PI"){ echo "selected";} ?> value="PI">Piauí</option>
															<option <?php if ($cliente['estado'] == "RJ"){ echo "selected";} ?> value="RJ">Rio de Janeiro</option>
															<option <?php if ($cliente['estado'] == "RN"){ echo "selected";} ?> value="RN">Rio Grande do Norte</option>
															<option <?php if ($cliente['estado'] == "RS"){ echo "selected";} ?> value="RS">Rio Grande do Sul</option>
															<option <?php if ($cliente['estado'] == "RO"){ echo "selected";} ?> value="RO">Rondônia</option>
															<option <?php if ($cliente['estado'] == "RR"){ echo "selected";} ?> value="RR">Roraima</option>
															<option <?php if ($cliente['estado'] == "SC"){ echo "selected";} ?> value="SC">Santa Catarina</option>
															<option <?php if ($cliente['estado'] == "SP"){ echo "selected";} ?> value="SP">São Paulo</option>
															<option <?php if ($cliente['estado'] == "SE"){ echo "selected";} ?> value="SE">Sergipe</option>
															<option <?php if ($cliente['estado'] == "TO"){ echo "selected";} ?> value="TO">Tocantins</option>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Município</label>
												    	<input type="text" class="form-control" value="<?= $cliente['municipio']?>" name="municipio" placeholder="Município">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Complemento</label>
												    	<input type="text" class="form-control" value="<?= $cliente['complemento']?>" name="complemento" placeholder="Complemento">
												    </div>
												</div>
												<div class="row">
													<div class="form-group col-md-3">
												      	<label class="col-form-label required">Telefone fixo</label>
												    	<input type="text" class="form-control phone_with_ddd" value="<?= $cliente['telefone_fixo']?>" name="telefone_fixo" placeholder="Telefone" required="true">
												    </div>
													<div class="form-group col-md-3">
												      	<label class="col-form-label">Telefone celular</label>
												    	<input type="text" class="form-control phone_with_ddd" value="<?= $cliente['telefone_celular']?>" name="telefone_celular" placeholder="Telefone">
												    </div>
													<div class="form-group col-md-6">
												      	<label class="col-form-label">Usuário</label>
												      	<select name="id_usuario" class="custom-select form-control">
														<?php 
														  	foreach ($usuarios as $key => $usuario) {
																if($usuario['id_usuario']==$cliente['id_usuario']){
																	echo "<option value='".$usuario['id_usuario']."' selected>".utf8_encode($usuario['nome'])."</option>";
																}else{
																	echo "<option value='".$usuario['id_usuario']."'>".utf8_encode($usuario['nome'])."</option>";
																}
														  	}
														?>
														</select>
													</div>
												</div>
												<div class="row">	
													<div class="form-group col-md-6">
												      	<label class="col-form-label">Observação</label>
												    	<textarea class="form-control" value="<?= $cliente['observacao']?>" name="observacao" placeholder="Observação"><?= $cliente['observacao']?></textarea>
												    </div>
												</div>
											</div>
	    									<div id="menu2-<?php echo $cliente['id_cliente']; ?>" class="tab-pane fade">
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 1</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" value="<?= $cliente['banco']?>" name="banco" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" value="<?= $cliente['agencia']?>" name="agencia" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" value="<?= $cliente['conta']?>" name="conta" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" value="<?= $cliente['descricao']?>" name="descricao" placeholder="Descrição"><?= $cliente['descricao']?></textarea>
												    </div>
												</div>
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 2</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" value="<?= $cliente['banco_2']?>" name="banco_2" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" value="<?= $cliente['agencia_2']?>" name="agencia_2" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" value="<?= $cliente['conta_2']?>" name="conta_2" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" value="<?= $cliente['descricao_2']?>" name="descricao_2" placeholder="Descrição"><?= $cliente['descricao_2']?></textarea>
												    </div>
												</div>
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 3</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" value="<?= $cliente['banco_3']?>" name="banco_3" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" value="<?= $cliente['agencia_3']?>" name="agencia_3" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" value="<?= $cliente['conta_3']?>" name="conta_3" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row">
												 -->	<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" value="<?= $cliente['descricao_3']?>" name="descricao_3" placeholder="Descrição"><?= $cliente['descricao_3']?></textarea>
												    </div>
												</div>
	    									</div>
	    									<div id="menu3-<?php echo $cliente['id_cliente']; ?>" class="tab-pane fade">
	    										<table class="table table-hover">
	    											<thead>
		    											<tr>
													        <th>Código</th>
													        <th>Nome</th>
													        <th>Telefone</th>
													        <th>E-mail</th>
												    	</tr>
												    </thead>
												    <tbody>
														<?php 
														$contatos = buscaContatos($conexao, $cliente['id_cliente']);
														if(!empty($contatos)){
															foreach ($contatos as $contato){ 
														?>    
													    <tr>
														    <td><?= $contato['id_contato'];?></td>
														    <td><?= $contato['nome'];?></td>
														    <td><?= $contato['telefone'];?></td>
														    <td><?= $contato['email'];?></td>
													    </tr>
														<?php
															}
														}else{
														?>
															<tr><td>Este cliente não possui nenhum contato</td></tr>
														<?php	
														}
														?>
												    </tbody>
	    										</table>
	    									</div>
	    									<div class="row">
												<div class="form-group col-md-12">
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button type="submit" class="btn btn-success" name="botaoEnviar">Salvar</button>
													</div>
												</div>
											</div>
										</div>	
									</form>
								</div>		
							</div>	
							<form action="remove-cliente.php" method="POST" name="form_exclusao_cliente">
								<input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Cliente</button>
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
    $sql = "select count(*) from cliente";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='cliente.php?page=".$i."'>".$i."</a></li>";  
    };  
    echo $pagLink . "</ul></nav>";  
    ?>
<script src="<?php echo $base_url; ?>/js/custom.js"></script>
<script src="<?php echo $base_url; ?>/js/consultaUsuario.js"></script>
<script>
	$(document).ready(function(){
  		$('.cep').mask('00000-000');
  		// $('.phone_with_ddd').mask('(00) 00000-0000');
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  		$('.cpf').mask('000.000.000-00', {reverse: true});
  		// $('.rg').mask('99.999.999-9', {reverse: true});
  		$('.data_nascimento').datepick({onSelect: function (){this.focus();}});
		$('#autocompleteUsuario').keyup(function() {
		    $('#id_usuario').val('');
		});
	});

	$(document).ready(function(){
		$('.pre-selected-options').multiSelect();
		$('.pagination').pagination({
			items: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page; ?>,
			hrefTextPrefix : 'cliente.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>