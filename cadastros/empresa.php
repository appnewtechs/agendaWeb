<?php 
require_once "../bootstrap.php";
require "../cabecalho.php";
?>

<div class="col-xs-12 breadcrumb">
	<span>CADASTROS > EMPRESA</span>
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
							<a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-empresa-modal-lg">
						    	<i class="glyphicon glyphicon-plus"></i>
							</a>
						</div>				        				    	
			<?php } ?>
						<!-- <div class="form-group col-xs-6">
					    	<div class="inner-addon right-addon">
						    	<i class="glyphicon glyphicon-search"></i>
						      	<input type="text" class="form-control" id="busca" placeholder="Informe o empresa..." />
						    </div>
						</div>	 -->			        
						<input type="hidden" name="tabela" id="tabela" value="empresa"/>
						<input type="hidden" name="modo" id="modo" value="<?=$modo?>"/>
						<input type="hidden" name="like" id="like" value="id_empresa,razao_social,nome_fantasia,cnpj"/>
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
						$empresas = ListaEmpresasPaginado($conexao, $page);
						if($modo==1){
						foreach ($empresas as $empresa){ 
						$empresa['razao_social'] = utf8_encode($empresa['razao_social']);
						$empresa['nome_fantasia'] = utf8_encode($empresa['nome_fantasia']);
					?>    
				    <tr data-toggle="modal" data-target=".bs-empresa-alterar-modal-lg-<?php echo $empresa['id_empresa']; ?>">
					    <!-- <td><?= $empresa['id_empresa'];?></td> -->
					    <td><?= $empresa['razao_social'];?></td>
					    <td><?= $empresa['nome_fantasia'];?></td>
					    <td><?php if($empresa['cnpj']!=""){echo $empresa['cnpj'];}else if($empresa['cpf']!=""){echo $empresa['cpf'];} ?></td>
					    <td><?= $empresa['telefone_fixo'];?></td>
				    </tr>
				    <?php
					}}else{
					foreach ($empresas as $empresa){ 
						$empresa['razao_social'] = utf8_encode($empresa['razao_social']);
						$empresa['nome_fantasia'] = utf8_encode($empresa['nome_fantasia']);
					?>  
				    <tr>
					    <!-- <td><?= $empresa['id_empresa'];?></td> -->
					    <td><?= $empresa['razao_social'];?></td>
					    <td><?= $empresa['nome_fantasia'];?></td>
					    <td><?php if($empresa['cnpj']!=""){echo $empresa['cnpj'];}else if($empresa['cpf']!=""){echo $empresa['cpf'];} ?></td>
					    <td><?= $empresa['telefone_fixo'];?></td>
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
<div class="modal fade bs-empresa-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Empresa</h4>
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
									<form class="form-horizontal formulario0" action="adiciona-empresa.php" method="post">
										<div class="tab-content">
	    									<div id="menu1" class="tab-pane fade in active">		  
												<div class="row">
													<?php 
														$tipos_empresa = buscaTiposEmpresa($conexao);
														$trabalhos_prestado = buscaTrabalhos($conexao);
													?>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Tipo de Empresa</label>
												     	<select name="tipo_empresa" class="custom-select form-control" required="true">
														<?php 
														  	foreach ($tipos_empresa as $key => $tipo_empresa) {
																echo "<option value='".$tipo_empresa['id_tipo_empresa']."'>".utf8_encode($tipo_empresa['descricao'])."</option>";
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
												      	<label class="col-form-label">Trabalho Prestado</label>
												    	<select name="trabalho_prestado" class="custom-select form-control">
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
												      			<option value="">Selecione um usuário</option>
												      		<?php

				// CONSULTA DA LISTAGEM
				$consulta_luser = mysqli_query($conexao,"SELECT id_usuario,nome FROM usuario ORDER BY id_usuario DESC") or die (mysqli_error());
				while($n_luser = mysqli_fetch_array($consulta_luser))
				{

					$id_luser				= $n_luser['id_usuario'];
					$nome_luser	= $n_luser['nome'];

					if(numeroentradas('empresa',"WHERE id_usuario='$id_luser'",$conexao) > 0)

					{

					}
					else
					{
					echo "<option value='".$id_luser."'>".utf8_encode($nome_luser)."</option>";

					}


				}
												      		?>
														<?php 
														  	foreach ($usuarios as $key => $usuario) {
																
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
<?php foreach ($empresas as $key => $empresa){  
$empresa['razao_social'] = utf8_encode($empresa['razao_social']);
$empresa['nome_fantasia'] = utf8_encode($empresa['nome_fantasia']);
$empresa['endereco'] = utf8_encode($empresa['endereco']);
$empresa['estado'] = utf8_encode($empresa['estado']);
$empresa['municipio'] = utf8_encode($empresa['municipio']);
$empresa['complemento'] = utf8_encode($empresa['complemento']);
$empresa['observacao'] = utf8_encode($empresa['observacao']);
$empresa['banco'] = utf8_encode($empresa['banco']);
$empresa['descricao'] = utf8_encode($empresa['descricao']);
$empresa['banco_2'] = utf8_encode($empresa['banco_2']);
$empresa['descricao_2'] = utf8_encode($empresa['descricao_2']);
$empresa['banco_3'] = utf8_encode($empresa['banco_3']);
$empresa['descricao_3'] = utf8_encode($empresa['descricao_3']);
$empresa['rg'] = utf8_encode($empresa['rg']);
$empresa['email'] = utf8_encode($empresa['email']);
	?>
<div class="modal fade bs-empresa-alterar-modal-lg-<?php echo $empresa['id_empresa']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Alterar Empresa</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">		  
									<ul class="nav nav-tabs">
									    <li class="active"><a data-toggle="tab" href="#menu1-<?php echo $empresa['id_empresa']; ?>">Dados Gerais</a></li>
									    <li><a data-toggle="tab" href="#menu2-<?php echo $empresa['id_empresa']; ?>">Financeiro</a></li>
								  	</ul>
									<form class="form-horizontal formulario<?= $key+1 ?>" action="altera-empresa.php" method="post">
										<input type="hidden" name="id_empresa" value="<?= $empresa['id_empresa']?>"/>
										<div class="tab-content">
	    									<div id="menu1-<?php echo $empresa['id_empresa']; ?>" class="tab-pane fade in active">		  
												<div class="row">
													<?php 
														$tipos_empresa = buscaTiposEmpresa($conexao);
														$trabalhos_prestado = buscaTrabalhos($conexao);
													?>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Tipo de Empresa</label>
												     	<select name="tipo_empresa" class="custom-select form-control" required="true">
														<?php 
														  	foreach ($tipos_empresa as $key => $tipo_empresa) {
																if($tipo_empresa['id_tipo_empresa']==$empresa['id_tipo_empresa']){
																	echo "<option value='".$tipo_empresa['id_tipo_empresa']."' selected>".utf8_encode($tipo_empresa['descricao'])."</option>";
																}else{
																	echo "<option value='".$tipo_empresa['id_tipo_empresa']."'>".utf8_encode($tipo_empresa['descricao'])."</option>";
																}
														  	}
														?>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label required">Prestador de Serv.</label>
												    	<select name="prestador_servico" class="custom-select form-control" required="true">
															<option <?php if ($empresa['prestador_servico'] == "1"){ echo "selected";} ?> value='1'>Sim</option>
															<option <?php if ($empresa['prestador_servico'] == "0"){ echo "selected";} ?> value='0'>Não</option>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Trabalho Prestado</label>
												    	<select name="trabalho_prestado" class="custom-select form-control">
												    	<?php 
														  	foreach ($trabalhos_prestado as $key => $trabalho_prestado) {
																if($trabalho_prestado['id_trabalho']==$empresa['id_trabalho']){
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
												      	<?php $data_nascimento = ""; if($empresa['data_nascimento'] != ""){$data_nascimento = date('d/m/Y', strtotime($empresa['data_nascimento'])); } ?>
										    			<input type="text" class="form-control data_nascimento" name="data_nascimento" value="<?= $data_nascimento ?>">
												    </div>
												</div>
												<div class="row">
												    <div class="form-group col-md-4">
												      	<label class="col-form-label required">Razão Social</label>
												     	<input type="text" class="form-control" value="<?= $empresa['razao_social']?>" name="razao_social" placeholder="Razão Social" required="true">
												    </div>
												    <div class="form-group col-md-4">
												      	<label class="col-form-label required">Nome Fantasia</label>
												    	<input type="text" class="form-control" value="<?= $empresa['nome_fantasia']?>" name="nome_fantasia" placeholder="Nome Fantasia" required="true">
												    </div>
												    <div class="form-group col-md-4">
												      	<label class="col-form-label">E-mail</label>
												    	<input type="text" class="form-control email" value="<?= $empresa['email']?>" name="email" placeholder="email">
												    </div>
												</div>
												<div class="row">
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CPF</label>
												     	<input type="text" class="form-control cpf" value="<?= $empresa['cpf']?>" name="cpf" placeholder="CPF">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CNPJ</label>
												    	<input type="text" class="form-control cnpj" value="<?= $empresa['cnpj']?>" name="cnpj" placeholder="CNPJ">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">RG</label>
												    	<input type="text" class="form-control rg" value="<?= $empresa['rg']?>" name="rg" placeholder="RG">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Endereço</label>
												    	<input type="text" class="form-control" value="<?= $empresa['endereco']?>" name="endereco" placeholder="Endereço">
												    </div>
												</div>		  
												<div class="row">
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">CEP</label>
												     	<input type="text" class="form-control cep" value="<?= $empresa['cep']?>" name="cep" placeholder="CEP">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Estado</label>
														<select name="estado" class="custom-select form-control">
															<option <?php if ($empresa['estado'] == "AC"){ echo "selected";} ?> value="AC">Acre</option>
															<option <?php if ($empresa['estado'] == "AL"){ echo "selected";} ?> value="AL">Alagoas</option>
															<option <?php if ($empresa['estado'] == "AP"){ echo "selected";} ?> value="AP">Amapá</option>
															<option <?php if ($empresa['estado'] == "AM"){ echo "selected";} ?> value="AM">Amazonas</option>
															<option <?php if ($empresa['estado'] == "BA"){ echo "selected";} ?> value="BA">Bahia</option>
															<option <?php if ($empresa['estado'] == "CE"){ echo "selected";} ?> value="CE">Ceará</option>
															<option <?php if ($empresa['estado'] == "DF"){ echo "selected";} ?> value="DF">Distrito Federal</option>
															<option <?php if ($empresa['estado'] == "ES"){ echo "selected";} ?> value="ES">Espirito Santo</option>
															<option <?php if ($empresa['estado'] == "GO"){ echo "selected";} ?> value="GO">Goiás</option>
															<option <?php if ($empresa['estado'] == "MA"){ echo "selected";} ?> value="MA">Maranhão</option>
															<option <?php if ($empresa['estado'] == "MS"){ echo "selected";} ?> value="MS">Mato Grosso do Sul</option>
															<option <?php if ($empresa['estado'] == "MT"){ echo "selected";} ?> value="MT">Mato Grosso</option>
															<option <?php if ($empresa['estado'] == "MG"){ echo "selected";} ?> value="MG">Minas Gerais</option>
															<option <?php if ($empresa['estado'] == "PA"){ echo "selected";} ?> value="PA">Pará</option>
															<option <?php if ($empresa['estado'] == "PB"){ echo "selected";} ?> value="PB">Paraíba</option>
															<option <?php if ($empresa['estado'] == "PR"){ echo "selected";} ?> value="PR">Paraná</option>
															<option <?php if ($empresa['estado'] == "PE"){ echo "selected";} ?> value="PE">Pernambuco</option>
															<option <?php if ($empresa['estado'] == "PI"){ echo "selected";} ?> value="PI">Piauí</option>
															<option <?php if ($empresa['estado'] == "RJ"){ echo "selected";} ?> value="RJ">Rio de Janeiro</option>
															<option <?php if ($empresa['estado'] == "RN"){ echo "selected";} ?> value="RN">Rio Grande do Norte</option>
															<option <?php if ($empresa['estado'] == "RS"){ echo "selected";} ?> value="RS">Rio Grande do Sul</option>
															<option <?php if ($empresa['estado'] == "RO"){ echo "selected";} ?> value="RO">Rondônia</option>
															<option <?php if ($empresa['estado'] == "RR"){ echo "selected";} ?> value="RR">Roraima</option>
															<option <?php if ($empresa['estado'] == "SC"){ echo "selected";} ?> value="SC">Santa Catarina</option>
															<option <?php if ($empresa['estado'] == "SP"){ echo "selected";} ?> value="SP">São Paulo</option>
															<option <?php if ($empresa['estado'] == "SE"){ echo "selected";} ?> value="SE">Sergipe</option>
															<option <?php if ($empresa['estado'] == "TO"){ echo "selected";} ?> value="TO">Tocantins</option>
														</select>
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Município</label>
												    	<input type="text" class="form-control" value="<?= $empresa['municipio']?>" name="municipio" placeholder="Município">
												    </div>
												    <div class="form-group col-md-3">
												      	<label class="col-form-label">Complemento</label>
												    	<input type="text" class="form-control" value="<?= $empresa['complemento']?>" name="complemento" placeholder="Complemento">
												    </div>
												</div>
												<div class="row">
													<div class="form-group col-md-3">
												      	<label class="col-form-label required">Telefone fixo</label>
												    	<input type="text" class="form-control phone_with_ddd" value="<?= $empresa['telefone_fixo']?>" name="telefone_fixo" placeholder="Telefone" required="true">
												    </div>
													<div class="form-group col-md-3">
												      	<label class="col-form-label">Telefone celular</label>
												    	<input type="text" class="form-control phone_with_ddd" value="<?= $empresa['telefone_celular']?>" name="telefone_celular" placeholder="Telefone">
												    </div>
													<div class="form-group col-md-6">
												      	<label class="col-form-label">Usuário</label>
												      	<select disabled name="id_usuario" class="custom-select form-control">


																<?php
				if($empresa['id_usuario'] != '')
				{
					echo '<option value="'.$empresa['id_usuario'].'" selected>'.chamacampo('usuario','nome',"WHERE id_usuario='".$empresa['id_usuario']."'",$conexao).'</option>';
				}
				// CONSULTA DA LISTAGEM
				$consulta_luser = mysqli_query($conexao,"SELECT id_usuario,nome FROM usuario ORDER BY id_usuario DESC") or die (mysqli_error());
				while($n_luser = mysqli_fetch_array($consulta_luser))
				{

					$id_luser				= $n_luser['id_usuario'];
					$nome_luser	= $n_luser['nome'];

					if(numeroentradas('empresa',"WHERE id_usuario='$id_luser'",$conexao) > 0)
					{

					}
					else
					{
						echo "<option value='".$id_luser."'>".utf8_encode($nome_luser)."</option>";

					}


				}
												      		?>
														<?php


/*
														  	foreach ($usuarios as $key => $usuario) {
																if($usuario['id_usuario']==$empresa['id_usuario']){
																	echo "<option value='".$usuario['id_usuario']."' selected>".$usuario['nome']."</option>";
																}else{
																	echo "<option value='".$usuario['id_usuario']."'>".$usuario['nome']."</option>";
																}
														  	}*/
														?>
														</select>
													</div>
												</div>
												<div class="row">	
													<div class="form-group col-md-6">
												      	<label class="col-form-label">Observação</label>
												    	<textarea class="form-control" value="<?= $empresa['observacao']?>" name="observacao" placeholder="Observação"><?= $empresa['observacao']?></textarea>
												    </div>
												</div>
											</div>
	    									<div id="menu2-<?php echo $empresa['id_empresa']; ?>" class="tab-pane fade">
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 1</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" value="<?= $empresa['banco']?>" name="banco" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" value="<?= $empresa['agencia']?>" name="agencia" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" value="<?= $empresa['conta']?>" name="conta" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" value="<?= $empresa['descricao']?>" name="descricao" placeholder="Descrição"><?= $empresa['descricao']?></textarea>
												    </div>
												</div>
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 2</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" value="<?= $empresa['banco_2']?>" name="banco_2" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" value="<?= $empresa['agencia_2']?>" name="agencia_2" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" value="<?= $empresa['conta_2']?>" name="conta_2" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row"> -->
													<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" value="<?= $empresa['descricao_2']?>" name="descricao_2" placeholder="Descrição"><?= $empresa['descricao_2']?></textarea>
												    </div>
												</div>
	    										<div class="row row-border">
	    											<div class="form-group col-md-12 line">
												      	<h4>Banco 3</h4>
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Banco</label>
												    	<input type="text" class="form-control" value="<?= $empresa['banco_3']?>" name="banco_3" placeholder="Banco">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Agência</label>
												    	<input type="text" class="form-control" value="<?= $empresa['agencia_3']?>" name="agencia_3" placeholder="Agência">
												    </div>
													<div class="form-group col-md-4">
												      	<label class="col-form-label">Conta</label>
												    	<input type="text" class="form-control" value="<?= $empresa['conta_3']?>" name="conta_3" placeholder="Conta">
												    </div>
												<!-- </div>
												<div class="row">
												 -->	<div class="form-group col-md-12">
												      	<label class="col-form-label">Descrição</label>
												    	<textarea class="form-control" value="<?= $empresa['descricao_3']?>" name="descricao_3" placeholder="Descrição"><?= $empresa['descricao_3']?></textarea>
												    </div>
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
										</div>	
									</form>
								</div>		
							</div>	
							<form action="remove-empresa.php" method="POST" name="form_exclusao_empresa">
								<input type="hidden" name="id_empresa" value="<?= $empresa['id_empresa']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Empresa</button>
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
    $sql = "select count(*) from empresa";  
    $rs_result = mysqli_query($conexao, $sql);  
    $row = mysqli_fetch_row($rs_result);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
                 $pagLink .= "<li><a href='empresa.php?page=".$i."'>".$i."</a></li>";  
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
			hrefTextPrefix : 'empresa.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>