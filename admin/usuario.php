<?php require_once("../banco-usuario.php") ?>
<?php require_once("../banco-cadastros.php") ?>
<?php require_once("../funcoes.php") ?>

<?php
$acao = $_GET['acao'];
$especialidade = '';
if($acao == 2){
	$id_usuario 		= $_GET['id_usuario'];
	$nome 				= chamacampo('usuario','nome',"WHERE id_usuario='$id_usuario'",$conexao);
	$login 				= chamacampo('usuario','login',"WHERE id_usuario='$id_usuario'",$conexao);
	$email 			    = chamacampo('usuario','email',"WHERE id_usuario='$id_usuario'",$conexao);
	$telefone 			= chamacampo('usuario','telefone',"WHERE id_usuario='$id_usuario'",$conexao);
	$data_nascimento 	= chamacampo('usuario','data_nascimento',"WHERE id_usuario='$id_usuario'",$conexao);
	$status 			= chamacampo('usuario','status',"WHERE id_usuario='$id_usuario'",$conexao);
	// $cor 				= chamacampo('usuario','cor',"WHERE id_usuario='$id_usuario'",$conexao);
	$id_empresa 		= chamacampo('usuario','id_empresa',"WHERE id_usuario='$id_usuario'",$conexao);
	$especialidade 		= chamacampo('usuario','especialidade',"WHERE id_usuario='$id_usuario'",$conexao);
	$id_linha_produto 	= chamacampo('usuario','id_linha_produto',"WHERE id_usuario='$id_usuario'",$conexao);
	$id_perfil 			= chamacampoarray2('usuario_perfil','id_perfil',"WHERE id_usuario='$id_usuario'",$conexao);
	$perfisUser = "";
	foreach ($id_perfil as $key => $perfil) {
		$nome_perfil = chamacampo('perfil','nome',"WHERE id_perfil='$perfil'",$conexao);
		if(sizeof($id_perfil) > $key+1){
			$perfisUser .= $nome_perfil."/";
		}else{
			$perfisUser .= $nome_perfil;
		}
	}
	// $nome_perfil 		= chamacampo('perfil','nome',"WHERE id_perfil='$id_perfil'",$conexao);
	$imagem 			= chamacampo('usuario','imagem',"WHERE id_usuario='$id_usuario'",$conexao); 
}
$focus = 'autofocus onfocus="var temp_value=this.value; this.value=\'\'; this.value=temp_value"';
?>
<div class="modal-body">
	<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-body">
						<form class="form-horizontal formulario"  enctype="multipart/form-data" action="<?php if($acao == 2){ echo "altera"; }else{echo "adiciona"; } ?>-usuario.php" method="post">
						<?php if($acao == 2){ ?>
							<input type="hidden" name="id_usuario" value="<?= $id_usuario?>"/>
							<input type="hidden" name="login" value="<?= $login?>"/>
							<?php } ?>
							<div class="row">
								<?php if($acao == 2){ ?>
							    <div class="form-group col-md-1">
							      	<label class="col-form-label">Codigo</label>
							      	<input disabled class="form-control" value="<?= @$id_usuario; ?>" type="text" name="id_usuario" id="id_usuario" required="true">
							    </div>

							    <div class="form-group col-md-2">
							    <?php }else{ ?>
							    <div class="form-group col-md-3">
							    <?php } ?>
							      	<label class="col-form-label required">Usuário</label>

							    	<input <?php if($acao == 2){ echo "disabled"; } ?> type="text" class="form-control" value="<?= @$login; ?>" name="login" required="true">
							    </div>
							    <?php if($acao == 2){ ?>
							    <div class="form-group col-md-3">
							    <?php }else{ ?>
							    <div class="form-group col-md-3">
							    <?php } ?>
							      	<label class="col-form-label required">Nome</label>

							    	<input type="text" class="form-control" value="<?= @$nome;?>" name="nome" required="true" <?php if($acao == 2){ echo $focus; } ?>>
							    </div>
							    <div class="form-group col-md-2">
							      	<label class="col-form-label <?php if($acao == 1){ echo "required"; } ?>">Senha</label>
							    	<input type="password" class="form-control" name="senha" <?php if($acao == 1){ echo "required"; } ?>>
							    </div>
							    <?php 
									$empresas = buscaEmpresasNome($conexao);
								?>
										    <div class="form-group col-md-4">
										      	<label class="col-form-label required">Empresa</label>
										     	<select name="empresa" class="custom-select form-control" required="true">
												<?php 
												  	foreach ($empresas as $key => $empresa) {
														if($empresa['id_empresa']==$id_empresa){
															echo "<option value='".$empresa['id_empresa']."' selected>".utf8_encode($empresa['nome_fantasia'])."</option>";
														}else{
															echo "<option value='".$empresa['id_empresa']."'>".utf8_encode($empresa['nome_fantasia'])."</option>";
														}
												  	}
												?>
												</select>
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
											if($linha_produto['id_linha_produto']==$id_linha_produto){
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
							      	<input class="form-control email" value="<?= @$email;?>" type="email" name="email" required="true">
							    </div>
							    <div class="form-group col-md-2">
							      	<label class="col-form-label">Telefone</label>
							    	<input type="text" class="form-control phone_with_ddd" value="<?= @$telefone;?>" name="telefone">
							    </div>
							    <div class="form-group col-md-2">
							      	<label class="col-form-label">Data de Nascimento</label>
							      	<?php $data_nascimento = ""; if($data_nascimento != NULL){$data_nascimento = date('d/m/Y', strtotime($data_nascimento)); } ?>
							    	<input class="form-control data_nascimento" name="data_nascimento" value="<?= @$data_nascimento ?>">
							    </div>
							    <div class="form-group col-md-2">
							      	<label class="col-form-label">Especialidade</label>
							      	<input class="form-control" value="<?= $especialidade;?>" type="text" name="especialidade" id="especialidade">
							    </div>
							</div>
							<div class="row multiSelectLabel">
								<div class="form-group col-md-5">
								    <label class="col-form-label required">Perfil de Usuário</label>
									<div class="form-group col-md-12">
									    <?php 
										    $perfis = buscaPerfis($conexao); 
										    $perfis_usuario = explode("/", @$perfisUser);
									    ?>
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

								<div class="form-group col-md-5">
								    <label class="col-form-label">Uploade de foto (.jpeg, .jpg ou .png)</label>
									<div class="form-group">
										<label class="btn col-md-12 btn-default">
										    Selecionar arquivo <input type="file" name="imagemUsuario">
											<?php if(strlen(@$imagem) > 0){ ?>
												<div>Imagem atual</div>
												<img src="<?php echo $base_url.'/'.$imagem; ?>" width="140" height="140" style="margin-top:10px" />
											<?php } ?>
										</label>
									</div>
								</div>
								<div class="form-group col-md-2">
									      	<label class="col-form-label required">Status</label>
									    	<select name="status" class="custom-select form-control" required="true">
												<option <?php if (@$status == "1"){ echo "selected";} ?> value='1'>Inativo</option>
												<option <?php if (@$status == "0"){ echo "selected";} ?> value='0'>Ativo</option>
											</select>
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
					<input type="hidden" name="id_usuario" value="<?= @$id_usuario?>"/>
					<input type="hidden" name="login" value="<?= @$login?>"/>
					<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Usuário</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- <script src="<?php echo $base_url; ?>/js/jscolor.js"></script> -->
<script>
	$(document).ready(function(){
	$('.pre-selected-options').multiSelect();
	$('.data_nascimento').datepick({onSelect: function (){this.focus();}});
	});
</script>

<?php include("../scripts.php") ?>