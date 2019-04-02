<?php require_once("../cabecalho.php") ?>
<?php require_once("../banco-usuario.php") ?>
<?php require_once("../funcoes.php") ?>

<div class="col-xs-12 breadcrumb">
	<span>ADMIN > USUARIO</span>
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
			<div id="cadastros" class="tab-pane fade in active">
				<div id="top" class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-pages">
					<?php if($modo==1){ ?>
						<div class="form-group col-xs-6">
							<a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-usuario-modal-lg"><i class="glyphicon glyphicon-plus"></i></a>
						</div>
						<?php } ?>
						<div class="form-group col-xs-6">
					    	<div class="inner-addon right-addon">
						    	<i class="glyphicon glyphicon-search"></i>
						      	<input type="text" class="form-control" id="busca" placeholder="Informe o usuário..." />
						    </div>
						</div>
						<input type="hidden" name="tabela" id="tabela" value="usuario"/>
						<input type="hidden" name="modo" id="modo" value="<?=$modo?>"/>
						<input type="hidden" name="like" id="like" value="nome,login,email"/>
						<input type="hidden" name="campos" id="campos" value="nome,login,email,telefone,nome_perfil,cor"/>
					</div>
				</div>
			</div>
			<table class="table table-hover default">
			    <thead>
			        <tr>
				        <th>Nome</th>
				        <th>Usuario</th>
				        <th>Empresa</th>
				        <th>E-mail</th>
				        <th>Telefone</th>
				        <th>Perfil</th>
				        <!-- <th>Cor</th> -->
			    	</tr>
			    </thead>
			    <tbody>
					<?php
						if (!isset($_GET["page"])) {
						  $page = "1";
						}else{
						  $page =$_GET["page"];
						}
						$usuarios = ListaUsuariosPaginado($conexao, $page);
						if($modo==1){
						foreach ($usuarios as $usuario){
							$usuario['nome'] = utf8_encode($usuario['nome']);
							$usuario['login'] = utf8_encode($usuario['login']); 
							$empresaNome = chamacampo('empresa','nome_fantasia',"WHERE id_empresa='".$usuario['id_empresa']."'",$conexao);
							$usuario['nome_perfil'] = utf8_encode($usuario['nome_perfil']);
					?>
				    <tr data-toggle="modal" data-target=".bs-usuario-alterar-modal-lg-<?php echo $usuario['id_usuario']; ?>">
					    <td><?= $usuario['nome'];?></td>
					    <td><?= $usuario['login'];?></td>
					    <td><?= $empresaNome; ?></td>
					    <td><?= $usuario['email']; ?></td>
					    <td><?= $usuario['telefone']; ?></td>
					    <td><?= $usuario['nome_perfil']; ?></td>
					    <!-- <td><div style="border:1px solid <?= $usuario['cor']; ?>;background-color:<?= $usuario['cor']; ?>;padding:10px;"></div></td> -->
				    </tr>
				    <?php
					}}else{
					foreach ($usuarios as $usuario){
							$usuario['nome'] = utf8_encode($usuario['nome']);
							$usuario['login'] = utf8_encode($usuario['login']);
							$usuario['nome_perfil'] = utf8_encode($usuario['nome_perfil']);
							$empresaNome = chamacampo('empresa','nome_fantasia',"WHERE id_empresa='".$usuario['id_empresa']."'",$conexao);
					?>
				    <tr>
					    <td><?= $usuario['nome'];?></td>
					    <td><?= $usuario['login'];?></td>
					    <td><?= $empresaNome; ?></td>
					    <td><?= $usuario['email']; ?></td>
					    <td><?= $usuario['telefone']; ?></td>
					    <td><?= $usuario['nome_perfil']; ?></td>
					    <!-- <td><div style="border:1px solid <?= $usuario['cor']; ?>;background-color:<?= $usuario['cor']; ?>;padding:10px;"></div></td> -->
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
				        <th>Usuario</th>
				        <th>E-mail</th>
				        <th>Telefone</th>
				        <th>Perfil</th>
				        <th>Cor</th>
			    	</tr>
			    </thead>
			    <tbody class="insert">

			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL PARA CADASTRO DE NOVO USUÁRIO -->
<div class="modal fade bs-usuario-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Usuário</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" enctype="multipart/form-data" action="adiciona-usuario.php" method="post">
										<div class="row">
										    <div class="form-group col-md-3">
										      	<label class="col-form-label required">Nome</label>
										    	<input type="text" class="form-control" name="nome" placeholder="Nome" required="true" autofocus>
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label required">Usuário</label>
										    	<input type="username" class="form-control" name="login" id="login" placeholder="Usuario" pattern="[a-zA-Z0-9]+" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label required">Senha</label>
										    	<input type="password" class="form-control" name="senha" placeholder="Senha" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Data de Nascimento</label>
										    	<input class="form-control data_nascimento" name="data_nascimento" placeholder="01/01/2000">
										    </div>
										    <div class="form-group col-md-3">
										      	<label class="col-form-label">Especialidade</label>
										    	<input type="text" class="form-control" name="especialidade" placeholder="Especialidade" autofocus>
										    </div>
										</div>
										<div class="row">
											<?php 
												$empresas = buscaEmpresasNome($conexao);
											?>
											<div class="form-group col-md-2">
											    <label class="col-form-label required">Empresa</label>
											    <select name="empresa" class="custom-select form-control" required="true">
												<?php 
													foreach ($empresas as $key => $empresa) {
														echo "<option value='".$empresa['id_empresa']."'>".utf8_encode($empresa['nome_fantasia'])."</option>";
													  	}
												?>
												</select>
											</div>
											<?php 
												$linhas_produtos = buscaLinhasProdutos($conexao);
											?>
											<div class="form-group col-md-3">
											    <label class="col-form-label required">Linha de Produto</label>
											    <select name="linha_produto" class="custom-select form-control" required="true">
												<?php 
													foreach ($linhas_produtos as $key => $linha_produto) {
														echo "<option value='".$linha_produto['id_linha_produto']."'>".utf8_encode($linha_produto['descricao'])."</option>";
													  	}
												?>
												</select>
											</div>
										    <div class="form-group col-md-3">
										      	<label class="col-form-label required">Email</label>
										    	<input type="email" class="form-control email" name="email" placeholder="Email" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Telefone</label>
										    	<input type="text" class="form-control phone_with_ddd" name="telefone" placeholder="Telefone">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Cor do Usuário</label>
										      	<input name="cor" class="jscolor form-control" value="0071c5">
										    </div>
										</div>
										<?php
											$perfis = buscaPerfis($conexao);
										?>
										<div class="row multiSelectLabel">
											<div class="form-group col-md-6">
											    <label class="col-form-label required">Perfil de Usuário</label>
												<div class="form-group col-md-12">
												    <select class='pre-selected-options' name="perfis[]" multiple='multiple' required>
													<?php
													  	foreach ($perfis as $key => $perfil) {
															echo "<option value='".$perfil['id_perfil']."'>".utf8_encode($perfil['nome'])."</option>";
													  	}
													?>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
											    <label class="col-form-label">Upload de foto (.jpeg, .jpg ou .png)</label>
													<div class="form-group">
														<label class="btn col-md-12 btn-default">
														    Selecionar arquivo <input type="file" name="imagemUsuario">
														</label>
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

<!-- MODAL PARA ALTERAÇÃO DE USUÁRIO -->
<?php foreach ($usuarios as $key => $usuario){ 
							$usuario['nome'] = utf8_encode($usuario['nome']);
							$usuario['login'] = utf8_encode($usuario['login']);
							$usuario['nome_perfil'] = utf8_encode($usuario['nome_perfil']);
							?>
<div class="modal fade bs-usuario-alterar-modal-lg-<?php echo $usuario['id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Usuário</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario<?= $key+1 ?>"  enctype="multipart/form-data" action="altera-usuario.php" method="post">
										<input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario']?>"/>
										<input type="hidden" name="login" value="<?= $usuario['login']?>"/>
										<div class="row">
										    <div class="form-group col-md-1">
										      	<label class="col-form-label">Codigo</label>
										      	<input disabled class="form-control" value="<?= $usuario['id_usuario'];?>" type="text" name="id_usuario" id="id_usuario" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label required">Usuário</label>
										    	<input disabled type="text" class="form-control" value="<?= $usuario['login'];?>" name="login" required="true">
										    </div>
										    <div class="form-group col-md-3">
										      	<label class="col-form-label required">Nome</label>
										    	<input type="text" class="form-control" value="<?= $usuario['nome'];?>" name="nome" required="true" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Senha</label>
										    	<input type="password" class="form-control" name="senha">
										    </div>
											<?php 
												$empresas = buscaEmpresasNome($conexao);
											?>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label required">Empresa</label>
										     	<select name="empresa" class="custom-select form-control" required="true">
												<?php 
												  	foreach ($empresas as $key => $empresa) {
														if($empresa['id_empresa']==$usuario['id_empresa']){
															echo "<option value='".$empresa['id_empresa']."' selected>".utf8_encode($empresa['nome_fantasia'])."</option>";
														}else{
															echo "<option value='".$empresa['id_empresa']."'>".utf8_encode($empresa['nome_fantasia'])."</option>";
														}
												  	}
												?>
												</select>
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Especialidade</label>
										      	<input class="form-control" value="<?= $usuario['especialidade'];?>" type="text" name="especialidade" id="especialidade">
										    </div>
										</div>
										<div class="row">
											<?php 
												$linhas_produtos = buscaLinhasProdutos($conexao);
											?>
										    <div class="form-group col-md-3">
										      	<label class="col-form-label required">Linha de Produto</label>
										     	<select name="linha_produto" class="custom-select form-control" required="true">
												<?php 
												  	foreach ($linhas_produtos as $key => $linha_produto) {
														if($linha_produto['id_linha_produto']==$usuario['id_linha_produto']){
															echo "<option value='".$linha_produto['id_linha_produto']."' selected>".utf8_encode($linha_produto['descricao'])."</option>";
														}else{
															echo "<option value='".$linha_produto['id_linha_produto']."'>".utf8_encode($linha_produto['descricao'])."</option>";
														}
												  	}
												?>
												</select>
										    </div>
										    <div class="form-group col-md-3">
										      	<label class="col-form-label required">E-mail</label>
										      	<input class="form-control email" value="<?= $usuario['email'];?>" type="email" name="email" required="true">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Telefone</label>
										    	<input type="text" class="form-control phone_with_ddd" value="<?= $usuario['telefone'];?>" name="telefone">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Data de Nascimento</label>
										      	<?php $data_nascimento = ""; if($usuario['data_nascimento'] != NULL){$data_nascimento = date('d/m/Y', strtotime($usuario['data_nascimento'])); } ?>
										    	<input class="form-control data_nascimento" name="data_nascimento" value="<?= $data_nascimento ?>">
										    </div>
										    <div class="form-group col-md-2">
										      	<label class="col-form-label">Cor do Usuário</label>
										      	<input name="cor" class="jscolor form-control" value="<?= $usuario['cor'];?>">
														<input name="imagem" type="hidden" class="form-control" value="<?= $usuario['imagem'];?>">
										    </div>
										</div>
										<div class="row multiSelectLabel">
											<div class="form-group col-md-6">
											    <label class="col-form-label required">Perfil de Usuário</label>
												<div class="form-group col-md-12">
												    <?php $perfis_usuario = explode("/", $usuario['nome_perfil']);?>
												    <select class='pre-selected-options' name="perfis[]" multiple='multiple' required>
													<?php
													  	foreach ($perfis as $key => $perfil) {
													  		if(array_search($perfil['nome'],$perfis_usuario)!==false){
																echo "<option value='".$perfil['id_perfil']."' selected>".utf8_encode($perfil['nome'])."</option>";
															}else{
																echo "<option value='".$perfil['id_perfil']."'>".utf8_encode($perfil['nome'])."</option>";
															}
													  	}
													?>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
											    <label class="col-form-label">Uploade de foto (.jpeg, .jpg ou .png)</label>
													<div class="form-group">
														<label class="btn col-md-12 btn-default">
														    Selecionar arquivo <input type="file" name="imagemUsuario">

													<?php if(strlen($usuario['imagem']) > 0){ ?>
														<div>Imagem atual</div>
														<img src="<?php echo $base_url.'/'.$usuario['imagem']; ?>" width="140" height="140" style="margin-top:10px" />
													<?php } ?>
												</label>
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
									</form>
								</div>
							</div>
							<form action="remove-usuario.php" method="POST" name="form_exclusao_usuario">
								<input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario']?>"/>
								<input type="hidden" name="login" value="<?= $usuario['login']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Usuário</button>
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
    $sql = "select count(*) from usuario";
    $rs_result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
    $pagLink = "<nav><ul class='pagination'>";
    for ($i=1; $i<=$total_pages; $i++) {
                 $pagLink .= "<li><a href='usuario.php?page=".$i."'>".$i."</a></li>";
    };
    echo $pagLink . "</ul></nav>";
    ?>
<script src="<?php echo $base_url; ?>/js/custom.js"></script>
<script src="<?php echo $base_url; ?>/js/jscolor.js"></script>
<script>
	$(document).ready(function(){
  		// $('.date').mask('00/00/0000');
  		// $('.phone_with_ddd').mask('(00) 00000-0000');
  		// $('.data_nascimento').mask('00/00/0000');
  		$('.data_nascimento').datepick({onSelect: function (){this.focus();}});
  	});
	$(document).ready(function(){
		$('.pre-selected-options').multiSelect();
		$('.pagination').pagination({
			items: <?php echo $total_records;?>,
			itemsOnPage: <?php echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php echo $page; ?>,
			hrefTextPrefix : 'usuario.php?page=',
			prevText: 'Anterior',
			nextText: 'Próximo'
		});
	});
</script>
<?php include("../rodape.php") ?>