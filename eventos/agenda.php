<?php
require_once "../bootstrap.php";
require "../cabecalho.php";
?>
<div id="Agenda"></div>
<?php
$pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

function searchForId2($id, $array)
{
	foreach ($array as $key => $val) {
		if ($val['id_rotina'] === $id) {
			return $val['edicao'];
		}
	}
	return null;
}

$usuarioLogado = buscaUsuario($conexao, $_SESSION["login"]);
$isAdmin = verificaAdmin($_SESSION["rotina"]);
$isCliente = verificaUsuarioCliente($conexao, $usuarioLogado["id_usuario"]);
$where = 'WHERE ';
foreach ($isCliente as $keyCliente => $valueCliente) {
	if ($keyCliente == 0) {
		$where .= "events.cliente = " . $valueCliente['id_cliente'];
	} else {
		$where .= "OR events.cliente = " . $valueCliente['id_cliente'];
	}
}
$isCliente = array_filter($isCliente);
$sql = '';
if ($isAdmin == 1) {
	$sql = "select events.*, usuario.nome as nome_usuario, trabalho.cor as cor_trabalho, 
	cliente.id_tipo_cliente as id_tipo_cliente FROM `events` 
	INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario 
	LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario 
	left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho where MONTH(start) = MONTH(CURRENT_DATE())
AND YEAR(start) = YEAR(CURRENT_DATE()) limit 100";
} else {
	$sql = 'select events.*, usuario.nome as nome_usuario, trabalho.cor as cor_trabalho, cliente.id_tipo_cliente as id_tipo_cliente FROM `events` INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho WHERE events.id_usuario = ' . $usuarioLogado["id_usuario"] . ' where MONTH(start) = MONTH(CURRENT_DATE())
AND YEAR(start) = YEAR(CURRENT_DATE()) limit 100';
}
if (!empty($isCliente)) {
	$sql = "select events.*, usuario.nome as nome_usuario, trabalho.cor as cor_trabalho, cliente.id_tipo_cliente as id_tipo_cliente FROM `events` INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho " . $where . ' where MONTH(start) = MONTH(CURRENT_DATE())
AND YEAR(start) = YEAR(CURRENT_DATE()) limit 100';
}
$req = $pdo->prepare($sql);
$req->execute();
$events = $req->fetchAll(PDO::FETCH_ASSOC);

$tipos_empresa = buscaTiposEmpresa($conexao);
$filtro_empresa = buscaEmpresasFiltro($conexao);
$filtro_trabalho = buscaTrabalhoFiltro($conexao);
$filtro_cliente = buscaClientesFiltro($conexao);
$filtro_linha_produto = buscaLinhasProdutoFiltro($conexao);
$usuarios_select = buscaUsuariosNome($conexao);
$empresas_select = buscaEmpresasNome($conexao);
$clientes_select = buscaClientesNome($conexao);
$linha_produtos_select = buscaLinhasProdutos($conexao);
$tipos_trabalho_select = buscaTiposTrabalho($conexao);
$usuarios = buscaUsuarios($conexao);
$id = searchForId2('3', $_SESSION["permissoesRotina"]);
$modo = $id;

$dados = [
	"tipos_empresa" => $tipos_empresa,
	"filtro_empresa" => $filtro_empresa,
	"filtro_trabalho" => $filtro_trabalho,
	"filtro_cliente" => $filtro_cliente,
	"filtro_linha_produto" => $filtro_linha_produto,
	"usuarios_select" => $usuarios_select,
	"empresas_select" => $empresas_select,
	"clientes_select" => $clientes_select,
	"linha_produtos_select" => $linha_produtos_select,
	"tipos_trabalho_select" => $tipos_trabalho_select,
	"usuarios" => $usuarios,
	"modo" => $modo
];

if (isset($_SESSION["danger"])) {
	echo "<p class='alert-danger'>" . $_SESSION["danger"] . "</p>";
	unset($_SESSION["danger"]);
}
?>
<script>
	var _DADOS = <?= json_encode($dados); ?>
</script>

<script src="http://localhost:8081/app.js"></script>
<?php exit ?>
<!-- Custom CSS -->
<style>
	#calendar {
		max-width: 800px;
	}

	.col-centered {
		float: none;
		margin: 0 auto;
	}

	.modal-body .col-sm-10 {
		padding-top: 10px;
	}

	.filtros {
		margin-left: 15px;
		text-align: left;
	}

	.filtros h3 {
		margin-top: 15px;
		margin-left: 0px;
	}

	.filtros h4 {
		margin-top: 15px;
		margin-left: 10px;
	}

	.filtro {
		overflow-y: auto;
		display: block;
		min-height: 50px;
		max-height: 400px;
		z-index: 99;
		margin-left: 15px;
	}

	.filtros .row {
		margin-left: -10px !important;
		margin-right: -10px !important;
	}

	.fa-arrow-down {
		float: right;
		transform: rotate(0deg);
		transition: transform 0.2s linear;
	}

	.fa-arrow-down.open {
		float: right;
		transform: rotate(-180deg);
		transition: transform 0.2s linear;
	}

	.filtrotoggle,
	.filtrotoggle2 {
		cursor: pointer !important;
	}
</style>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Page Content -->
<!-- <div class="container"> -->

<div class="row">
	<!-- <div class="col-lg-12 text-center"> -->
	<?php if ($isAdmin == 1) { ?>
		<div class="col-sm-2">
			<div class="row filtros">
				<div class="row">
					<div class="col-sm-12">
						<h3>Filtros</h3>
					</div>
				</div>
				<div class="row filtrotoggle2">
					<div class="row">
						<div class="col-sm-12">
							<h4>Usuario
								<i id="icon" class="fa fa-arrow-down open"></i></h4>
						</div>
					</div>
					<?php
					$selected_usuario = explode(",", @$_GET['selected_usuario']);
					$selected_empresa = explode(",", @$_GET['selected_empresa']);
					$selected_trabalho = explode(",", @$_GET['selected_trabalho']);
					$selected_cliente = explode(",", @$_GET['selected_cliente']);
					$checked = '';
					?>
					<div class="row">
						<div class="col-sm-12 filtro" id='checkbox-form-usuario'>
							<?php foreach ($usuarios as $key => $value) {
								echo "<div class='form-check row'  style='margin-left:10px;'>";
								if (in_array($value['id_usuario'], $selected_usuario)) {
									$checked = 'checked';
								}
								echo "<label class='form-check-label'><input class='form-check-input' type='checkbox' " . $checked . " value='" . $value['id_usuario'] . "' id='e" . $value['id_usuario'] . "' name='checkbox[]'> " . utf8_encode($value['nome']) . "</label>";
								echo "</div>";
								$checked = '';
							} ?>
						</div>
					</div>
				</div>
				<!-- 		<div class="row">
																		<div class="row">
																			<div class="col-sm-12">
																				<h4>Empresas</h4>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-sm-12 filtro" id='checkbox-form-usuario'>
																			<?php foreach ($profissionais as $key => $value) {
																				echo "<div class='form-check row'  style='margin-left:10px;'>";
																				echo "<label class='form-check-label'><input class='form-check-input' type='checkbox' value='" . $value['id_usuario'] . "' id='e" . $value['id_usuario'] . "' name='checkbox[]'> <div class='calListSquare' style='background:#" . $value['cor'] . ";border-color:#" . $value['cor'] . "'></div>" . utf8_encode($value['nome']) . "</label>";
																				echo "</div>";
																			} ?>
																				</div>
																			</div>
																		</div> -->
				<div class="row filtrotoggle">
					<div class="row">
						<div class="col-sm-12">
							<h4 ">Tipos de Trabalho
																					<i id=" icon" class="fa fa-arrow-down"></i></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 filtro" id='checkbox-form-trabalho'>
							<?php foreach ($filtro_trabalho as $key => $value) {
								echo "<div class='form-check row'  style='margin-left:10px;'>";
								if (in_array($value['id_trabalho'], $selected_trabalho)) {
									$checked = 'checked';
								}
								echo "<label class='form-check-label'><input class='form-check-input' type='checkbox' " . $checked . " value='" . $value['id_trabalho'] . "' id='e" . $value['id_trabalho'] . "' name='checkbox[]'> <div class='calListSquare' style='background:#" . $value['cor'] . ";border-color:#" . $value['cor'] . "'></div>" . utf8_encode($value['descricao']) . "</label>";
								echo "</div>";
								$checked = '';
							} ?>
						</div>
					</div>
				</div>
				<div class="row filtrotoggle">
					<div class="row">
						<div class="col-sm-12">
							<h4 ">Empresas
																				<i id=" icon" class="fa fa-arrow-down"></i></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 filtro" id='checkbox-form-empresa'>
							<?php foreach ($filtro_empresa as $key => $value) {
								echo "<div class='form-check row'  style='margin-left:10px;'>";
								if (in_array($value['id_empresa'], $selected_empresa)) {
									$checked = 'checked';
								}
								echo "<label class='form-check-label'><input class='form-check-input' type='checkbox' " . $checked . " value='" . $value['id_empresa'] . "' id='e" . $value['id_empresa'] . "' name='checkbox[]'> " . utf8_encode($value['nome_fantasia']) . "</label>";
								echo "</div>";
								$checked = '';
							} ?>
						</div>
					</div>
				</div>
				<div class="row filtrotoggle">
					<div class="row">
						<div class="col-sm-12">
							<h4 ">Clientes
																				<i id=" icon" class="fa fa-arrow-down"></i></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 filtro" id='checkbox-form-cliente'>
							<?php foreach ($filtro_cliente as $key => $value) {
								echo "<div class='form-check row'  style='margin-left:10px;'>";
								if (in_array($value['id_cliente'], $selected_cliente)) {
									$checked = 'checked';
								}
								echo "<label class='form-check-label'><input class='form-check-input' type='checkbox' " . $checked . " value='" . $value['id_cliente'] . "' id='e" . $value['id_cliente'] . "' name='checkbox[]'> " . utf8_encode($value['nome_fantasia']) . "</label>";
								echo "</div>";
								$checked = '';
							} ?>
						</div>
					</div>
				</div>
				<div class="row filtrotoggle">
					<div class="row">
						<div class="col-sm-12">
							<h4 ">Linhas de Produto
																				<i id=" icon" class="fa fa-arrow-down"></i></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 filtro" id='checkbox-form-linha-produto'>
							<?php foreach ($filtro_linha_produto as $key => $value) {
								echo "<div class='form-check row'  style='margin-left:10px;'>";
								echo "<label class='form-check-label'><input class='form-check-input' type='checkbox' value='" . $value['id_linha_produto'] . "' id='e" . $value['id_linha_produto'] . "' name='checkbox[]'> " . utf8_encode($value['descricao']) . "</label>";
								echo "</div>";
							} ?>
						</div>
					</div>
				</div>
				<div class="row">
					<form class="form-horizontal" target="_blank" enctype="multipart/form-data" action="relatorio.php" method="post">
						<div class="row">
							<div class="col-sm-12">
								<h4 ">Datas pro relatório
																				</div>
																			</div>
																			<div class=" row">
									<div class="col-sm-12">
										<input type="text" required="true" class="form-control duasdatas dates" autocomplete="off" name="datas_evento" placeholder="Datas do Evento">
									</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-success gerarRelatorio" name="botaoEnviar" style="width: 100%;">Gerar Relatório</button>
								</div>
							</div>
							<input type="hidden" name="selected_usuario">
							<input type="hidden" name="selected_empresa">
							<input type="hidden" name="selected_trabalho">
							<input type="hidden" name="selected_cliente">
							<input type="hidden" name="selected_linha_produto">
					</form>
				</div>


			</div>
		</div>
		<div class="col-sm-10">
		<?php
	} else { ?>
			<div class="col-sm-12">
			<?php
		} ?>
			<?php if ($modo == 1) { ?>
				<div class="novoEventoDiv"><a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo novoEvento" data-toggle="modal" data-target=".bs-ficha-trabalho-modal-lg"><i class="glyphicon glyphicon-plus"></i> Novo evento</a></div>
			<?php
		} ?>
			<div id="calendario" class="" style="padding: 30px;"></div>
		</div>
	</div>

	<!-- </div> -->
	<!-- /.row -->
	<!-- Modal -->
	<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal formulario0" method="POST" action="addEvent.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;
							</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Adicionar Evento
						</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" name="add_selected_usuario">
						<input type="hidden" name="add_selected_empresa">
						<input type="hidden" name="add_selected_trabalho">
						<input type="hidden" name="add_selected_cliente">
						<input type="hidden" name="add_selected_linha_produto">
						<!-- <div class="form-group">
						<label class="control-label col-sm-2">Usuario
						</label>
						<div class="col-sm-10">
							<input class="form-control" type="text" name="autocompleteUsuario" id="autocompleteUsuario" placeholder="Informe o Usuario..." required="true" autofocus>
						</div>
						<input type="hidden" id="id_usuario" name="id_usuario"/>
					</div> -->
						<div class="form-group">
							<label class="control-label col-sm-2 required">Usuário</label>

							<div class="col-sm-10">
								<select name="id_usuario" class="custom-select form-control" required="true">
									<?php
									foreach ($usuarios_select as $key => $usuario_select) {
										echo "<option value='" . $usuario_select['id_usuario'] . "'>" . utf8_encode($usuario_select['nome']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Empresa</label>

							<div class="col-sm-10">
								<select name="empresa" class="custom-select form-control">
									<?php
									foreach ($empresas_select as $key => $empresa_select) {
										echo "<option value='" . $empresa_select['id_empresa'] . "'>" . utf8_encode($empresa_select['nome_fantasia']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2 required">Tipo de Trabalho</label>

							<div class="col-sm-10">
								<select name="tipo_trabalho" class="custom-select form-control" required="true">
									<?php
									foreach ($tipos_trabalho_select as $key => $tipo_trabalho_select) {
										echo "<option value='" . $tipo_trabalho_select['id_trabalho'] . "'>" . utf8_encode($tipo_trabalho_select['descricao']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Titulo
							</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Titulo" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Datas do Evento
							</label>
							<div class="col-sm-10">
								<input type="text" required="true" class="form-control multipledates dates" autocomplete="off" name="datas_trabalho" placeholder="Datas do Evento">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Status
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="status">

									<option value="1">Confirmado</option>
									<option value="0">A confirmar</option>

								</select>
								<!-- <input type="text" class="form-control " name="fechado" placeholder=""> -->
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Fechar dia
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="fechado">

									<option value="0">Dia aberto</option>
									<option value="1">Bloquar dia inteiro</option>

								</select>
								<!-- <input type="text" class="form-control " name="fechado" placeholder=""> -->
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Cliente</label>

							<div class="col-sm-10">
								<select name="cliente" class="custom-select form-control">
									<?php
									foreach ($clientes_select as $key => $cliente_select) {
										echo "<option value='" . $cliente_select['id_cliente'] . "'>" . utf8_encode($cliente_select['nome_fantasia']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar
						</button>
						<button type="submit" class="btn btn-primary" id="addEvent">Salvar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal formulario1" method="POST" action="editEventTitle.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;
							</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Editar Evento
						</h4>
					</div>
					<input type="hidden" name="edit_selected_usuario">
					<input type="hidden" name="edit_selected_empresa">
					<input type="hidden" name="edit_selected_trabalho">
					<input type="hidden" name="edit_selected_cliente">
					<input type="hidden" name="edit_selected_linha_produto">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-sm-2">Usuario
							</label>
							<div class="col-sm-10">
								<input class="form-control" disabled type="text" name="autocompleteUsuario" id="autocompleteUsuario" placeholder="Informe o Usuario..." required="true">
							</div>
							<input type="hidden" id="id_usuario" name="id_usuario" />
							<input type="hidden" id="id_evento" name="id_evento" />
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Empresa</label>

							<div class="col-sm-10">
								<select name="empresa" class="custom-select form-control" id="empresa">
									<?php
									foreach ($empresas_select as $key => $empresa_select) {
										echo "<option value='" . $empresa_select['id_empresa'] . "'>" . utf8_encode($empresa_select['nome_fantasia']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>

						<!-- 					<div class="form-group">
						<label class="control-label col-sm-2 required">Linha de Produto</label>

						<div class="col-sm-10">
				      	<select name="linha_produto" class="custom-select form-control" id="linha_produto" required="true">
						<?php
						foreach ($linha_produtos_select as $key => $linha_produto_select) {
							echo "<option value='" . $linha_produto_select['id_linha_produto'] . "'>" . utf8_encode($linha_produto_select['descricao']) . "</option>";
						}
						?>
						</select>
						</div>
					</div> -->

						<div class="form-group">
							<label class="control-label col-sm-2 required">Tipo de Trabalho</label>

							<div class="col-sm-10">
								<select name="tipo_trabalho" class="custom-select form-control" id="tipo_trabalho" required="true">
									<?php
									foreach ($tipos_trabalho_select as $key => $tipo_trabalho_select) {
										echo "<option value='" . $tipo_trabalho_select['id_trabalho'] . "'>" . utf8_encode($tipo_trabalho_select['descricao']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Titulo
							</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Titulo" required="true" autofocus>
							</div>
						</div>
						<!-- 	<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Descrição
						</label>
						<div class="col-sm-10">
							<textarea name="descricao" class="form-control" id="descricao" placeholder="Descrição"></textarea>
						</div>
					</div> -->

						<div class="form-group">
							<label for="start" class="col-sm-2 control-label required">Datas do Evento
							</label>
							<div class="col-sm-10">
								<input type="text" class="form-control multipledates dates" id="datas_trabalho" autocomplete="off" name="datas_trabalho" placeholder="Datas do Evento">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Status
							</label>
							<div class="col-sm-10">
								<select class="form-control" id="status" name="status">

									<option value="1">Confirmado</option>
									<option value="0">A confirmar</option>

								</select>
								<!-- <input type="text" class="form-control " name="fechado" placeholder=""> -->
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Fechar dia
							</label>
							<div class="col-sm-10">
								<select class="form-control" id="fechado" name="fechado">

									<option value="0">Dia aberto</option>
									<option value="1">Bloquar dia inteiro</option>

								</select>
								<!-- <input type="text" class="form-control " name="fechado" placeholder=""> -->
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Cliente</label>

							<div class="col-sm-10">
								<select name="cliente" class="custom-select form-control" id="cliente">
									<?php
									foreach ($clientes_select as $key => $cliente_select) {
										echo "<option value='" . $cliente_select['id_cliente'] . "'>" . utf8_encode($cliente_select['nome_fantasia']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label class="text-danger">
										<input type="checkbox" name="delete"> Deletar Evento
									</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="id" class="form-control" id="id">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar
						</button>
						<button type="submit" class="btn btn-primary" id="editEventTitle">Salvar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="ModalVisualizacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal formulario1" method="POST" action="javascript:void(0);">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;
							</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Editar Evento
						</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-sm-2">Usuario
							</label>
							<div class="col-sm-10">
								<input class="form-control" disabled type="text" name="autocompleteUsuario" id="autocompleteUsuario" placeholder="Informe o Usuario..." required="true">
							</div>
							<input type="hidden" id="id_usuario" name="id_usuario" />
							<input type="hidden" id="id_evento" name="id_evento" />
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Empresa</label>

							<div class="col-sm-10">
								<select name="empresa" disabled class="custom-select form-control" id="empresa">
									<?php
									foreach ($empresas_select as $key => $empresa_select) {
										echo "<option value='" . $empresa_select['id_empresa'] . "'>" . utf8_encode($empresa_select['nome_fantasia']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>

						<!-- 		<div class="form-group">
						<label class="control-label col-sm-2 required">Linha de Produto</label>

						<div class="col-sm-10">
				      	<select name="linha_produto" disabled class="custom-select form-control" id="linha_produto" required="true">
						<?php
						foreach ($linha_produtos_select as $key => $linha_produto_select) {
							echo "<option value='" . $linha_produto_select['id_linha_produto'] . "'>" . utf8_encode($linha_produto_select['descricao']) . "</option>";
						}
						?>
						</select>
						</div>
					</div> -->
						<div class="form-group">
							<label class="control-label col-sm-2 required">Tipo de Trabalho</label>

							<div class="col-sm-10">
								<select name="tipo_trabalho" disabled class="custom-select form-control" id="tipo_trabalho" required="true">
									<?php
									foreach ($tipos_trabalho_select as $key => $tipo_trabalho_select) {
										echo "<option value='" . $tipo_trabalho_select['id_trabalho'] . "'>" . utf8_encode($tipo_trabalho_select['descricao']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Titulo
							</label>
							<div class="col-sm-10">
								<input type="text" name="title" disabled class="form-control" id="title" placeholder="Titulo" required="true" autofocus>
							</div>
						</div>
						<!-- 			<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Descrição
						</label>
						<div class="col-sm-10">
							<textarea name="descricao" disabled class="form-control" id="descricao" placeholder="Descrição"></textarea>
						</div>
					</div> -->

						<div class="form-group">
							<label for="start" class="col-sm-2 control-label required">Datas do Evento
							</label>
							<div class="col-sm-10">
								<input type="text" class="form-control multipledates dates" id="datas_trabalho" autocomplete="off" name="datas_trabalho" placeholder="Datas do Evento">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Status
							</label>
							<div class="col-sm-10">
								<select disabled class="form-control" id="status" name="status">

									<option value="1">Confirmado</option>
									<option value="0">A confirmar</option>

								</select>
								<!-- <input type="text" class="form-control " name="fechado" placeholder=""> -->
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Fechar dia
							</label>
							<div class="col-sm-10">
								<select disabled class="form-control" id="fechado" name="fechado">

									<option value="0">Dia aberto</option>
									<option value="1">Bloquar dia inteiro</option>

								</select>
								<!-- <input type="text" class="form-control " name="fechado" placeholder=""> -->
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Cliente</label>

							<div class="col-sm-10">
								<select name="cliente" disabled class="custom-select form-control" id="cliente">
									<?php
									foreach ($clientes_select as $key => $cliente_select) {
										echo "<option value='" . $cliente_select['id_cliente'] . "'>" . utf8_encode($cliente_select['nome_fantasia']) . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<input type="hidden" name="id" class="form-control" id="id">
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Fechar
					</button>
					<button type="submit" class="btn btn-primary">Salvar
					</button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- </div> -->
	<!-- /.container -->
	<script>
		$(document).ready(function() {
			// 	var ta = document.querySelector('#ModalAdd #descricao');
			// 	autosize(ta);
			$('.novoEvento').click(function() {
				$('#ModalAdd').modal('show');
			});




			$(document).on('click', '.gerarRelatorio', function() {

				var selected_usuario = [];
				var selected_empresa = [];
				var selected_trabalho = [];
				var selected_cliente = [];
				var selected_linha_produto = [];

				$('#checkbox-form-usuario input:checked').each(function() {
					selected_usuario.push($(this).val());
				});
				$('#checkbox-form-trabalho input:checked').each(function() {
					selected_trabalho.push($(this).val());
				});
				$('#checkbox-form-empresa input:checked').each(function() {
					selected_empresa.push($(this).val());
				});
				$('#checkbox-form-cliente input:checked').each(function() {
					selected_cliente.push($(this).val());
				});
				$('#checkbox-form-linha-produto input:checked').each(function() {
					selected_linha_produto.push($(this).val());
				});

				$('input[name="selected_usuario"]').val(selected_usuario);
				$('input[name="selected_empresa"]').val(selected_empresa);
				$('input[name="selected_trabalho"]').val(selected_trabalho);
				$('input[name="selected_cliente"]').val(selected_cliente);
				$('input[name="selected_linha_produto"]').val(selected_linha_produto);

			});

			// 	function htmlEscape(s) {
			//     return s.replace(/&/g, '&amp;')
			//     .replace(/</g, '&lt;')
			//     .replace(/>/g, '&gt;')
			//     .replace(/'/g, '&#039;')
			//     .replace(/"/g, '&quot;')
			//     .replace(/\n/g, '<br />')
			//     .replace(/&lt;br\s?\/?&gt;/g, '<br />');
			// }
			// $('.multipledates').multiDatesPicker();
			$(' select[name="id_usuario"]').change(function() {
				var usuario = $(this).val();
				$.ajax({
					url: "select-empresa.php",
					method: "POST",
					data: {
						usuario: usuario
					},
					dataType: "text",
					success: function(data) {
						//Mensagem de resultado 
						$(' select[name="empresa"]').val(data);
					}
				})
			});
			$('.multipledates').datepick({
				multiSelect: 999
			});
			$('.duasdatas').datepick({
				multiSelect: 2
			});
			$('#checkbox-form-empresa').hide();
			$('#checkbox-form-cliente').hide();
			$('#checkbox-form-linha-produto').hide();
			// $('#checkbox-form-linha-produto').hide();
			var open2 = true;
			$('.filtrotoggle2 h4').click(function() {
				if (open2) {
					$(this).parent().parent().parent().find("#icon").removeClass('open');
				} else {
					$(this).parent().parent().parent().find("#icon").addClass('open');
				}
				$(this).parent().parent().parent().find('.filtro').toggle();
				open2 = !open2;
			});
			var open = false;
			$('.filtrotoggle h4').click(function() {
				if (open) {
					$(this).parent().parent().parent().find("#icon").removeClass('open');
				} else {
					$(this).parent().parent().parent().find("#icon").addClass('open');
				}
				$(this).parent().parent().parent().find('.filtro').toggle();
				open = !open;
			});

			$('.date_time').mask('00-00-0000 00:00:00');

			$('.form-check-input').on('change', function() {
				$('#calendario').fullCalendar('rerenderEvents');
			});
			<?php if ($modo == 1) { ?>
				$('#calendario').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,basicWeek,basicDay'
					},
					// defaultView: 'basicWeek',
					buttonText: {
						today: '<<'
					},
					// height: 650,
					editable: false,
					displayEventTime: false,
					eventLimit: false, // allow "more" link when too many events
					selectable: true,
					selectHelper: false,
					select: function(start, end) {
						$('#ModalAdd #start').val(moment(start).format('DD-MM-YYYY HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('DD-MM-YYYY HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					eventRender: function(event, element) {
						element.find(".fc-title").html(event.titulo);
						if (event.icon) {
							element.find(".fc-title").prepend("<i class='fa " + event.icon + "'> </i> ");
						}
						element.bind('click', function() {
							id_evento = event.id_evento;
							console.log(event);
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);

							// var regex = /<br\s*[\/]?>/gi;
							// $('#ModalEdit #descricao').html(event.descricao.replace(regex, "\n"));

							$('#ModalEdit #id_usuario').val(event.id_usuario);
							$('#ModalEdit #id_evento').val(event.id_evento);
							$('#ModalEdit #fechado').val(event.fechado);
							$('#ModalEdit #status').val(event.status);
							console.log(event.status);
							// $('#ModalEdit #linha_produto').val(event.id_linha_produto);
							$('#ModalEdit #empresa').val(event.empresa);
							$('#ModalEdit #cliente').val(event.cliente);
							$('#ModalEdit #tipo_trabalho').val(event.tipo_trabalho);
							$.ajax({
								url: "select-datas.php",
								method: "POST",
								data: {
									id_evento: id_evento
								},
								success: function(data) {
									dataResultado = data.split(',');
									console.log('depois:' + dataResultado);
									//    			$('#ModalEdit #datas_trabalho').multiDatesPicker('resetDates');
									//          $('#ModalEdit #datas_trabalho').multiDatesPicker({
									// 	addDates: dataResultado
									// });
									$('#ModalEdit #datas_trabalho').val(dataResultado);
									// var ta = document.querySelector('#ModalEdit #descricao');
									// autosize(ta);
									// autosize.update(ta);
								}
							});

							$('#ModalEdit #autocompleteUsuario').val(event.nome_usuario);
							// $('#ModalEdit #color').val(event.color);
							$('#ModalEdit').modal('show');
						});



						var display = true;
						var selected_usuario = [];
						var selected_empresa = [];
						var selected_trabalho = [];
						var selected_cliente = [];
						// var selected_linha_produto = [];

						$('#checkbox-form-usuario input:checked').each(function() {
							selected_usuario.push($(this).val());
						});
						$('#checkbox-form-trabalho input:checked').each(function() {
							selected_trabalho.push($(this).val());
						});
						$('#checkbox-form-empresa input:checked').each(function() {
							selected_empresa.push($(this).val());
						});
						$('#checkbox-form-cliente input:checked').each(function() {
							selected_cliente.push($(this).val());
						});

						$('input[name="add_selected_usuario"]').val(selected_usuario);
						$('input[name="add_selected_empresa"]').val(selected_empresa);
						$('input[name="add_selected_trabalho"]').val(selected_trabalho);
						$('input[name="add_selected_cliente"]').val(selected_cliente);
						// $('input[name="add_selected_linha_produto"]').val(selected_linha_produto);

						$('input[name="edit_selected_usuario"]').val(selected_usuario);
						$('input[name="edit_selected_empresa"]').val(selected_empresa);
						$('input[name="edit_selected_trabalho"]').val(selected_trabalho);
						$('input[name="edit_selected_cliente"]').val(selected_cliente);
						// $('input[name="edit_selected_linha_produto"]').val(selected_linha_produto);

						// $('#checkbox-form-linha-produto input:checked').each(function() {

						//           selected_linha_produto.push($(this).val());
						//       });

						// If there are locations to check
						if (selected_usuario.length) {
							display = display && selected_usuario.indexOf(event.id_usuario) >= 0;
						}
						if (selected_empresa.length) {
							display = display && selected_empresa.indexOf(event.empresa) >= 0;
						}
						if (selected_trabalho.length) {
							display = display && selected_trabalho.indexOf(event.tipo_trabalho) >= 0;
						}
						if (selected_cliente.length) {
							display = display && selected_cliente.indexOf(event.cliente) >= 0;
						}
						// if (selected_linha_produto.length) {
						//     display = display && selected_linha_produto.indexOf(event.id_linha_produto) >= 0;
						// }

						return display;


					},
					eventDrop: function(event, delta, revertFunc) {
						// si changement de position
						edit(event);
					},
					eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
						// si changement de longueur
						edit(event);
					},
					events: [
						<?php foreach ($events as $event) :
							$desc = enter($event['descricao']);
							$start = explode(" ", $event['start']);
							$end = explode(" ", $event['end']);
							$cliente = chamacampo('cliente', 'nome_fantasia', "WHERE id_cliente='" . $event['cliente'] . "'", $conexao);
							$titulo = $event['nome_usuario'] . ' - ' . $event['title'];
							if ($start[1] == '00:00:00') {
								$start = $start[0];
							} else {
								$start = $event['start'];
							}
							if ($end[1] == '00:00:00') {
								$end = $end[0];
							} else {
								$end = $event['end'];
							}
							$iconblock = '';
							if ($event['fechado'] == 1) {
								$iconblock = 'fa-lock';
							}
							?> {
								id: '<?php echo $event['id']; ?>',
								id_evento: '<?php echo $event['id_evento']; ?>',
								title: '<?php echo $event['title']; ?>',
								start: '<?php echo $start; ?>',
								end: '<?php echo $end; ?>',
								icon: '<?php echo $iconblock; ?>',
								color: '<?php echo $event['cor_trabalho']; ?>',
								id_usuario: '<?php echo $event['id_usuario']; ?>',
								// descricao: '<?php echo $desc; ?>',
								nome_usuario: '<?php echo $event['nome_usuario']; ?>',
								id_tipo_cliente: '<?php echo $event['id_tipo_cliente']; ?>',
								fechado: '<?php echo $event['fechado']; ?>',
								status: '<?php echo $event['status']; ?>',
								// id_linha_produto: '<?php echo $event['id_linha_produto']; ?>',
								empresa: '<?php echo $event['empresa']; ?>',
								cliente: '<?php echo $event['cliente']; ?>',
								tipo_trabalho: '<?php echo $event['tipo_trabalho']; ?>',
								titulo: '<?php echo $titulo; ?>'
							},
						<?php endforeach; ?>
					]
				});

				function edit(event) {
					start = event.start.format('YYYY-MM-DD HH:mm:ss');
					if (event.end) {
						end = event.end.format('YYYY-MM-DD HH:mm:ss');
					} else {
						end = start;
					}
					id = event.id;
					Event = [];
					Event[0] = id;
					Event[1] = start;
					Event[2] = end;
					$.ajax({
						url: 'editEventDate.php',
						type: "POST",
						data: {
							Event: Event
						},
						success: function(rep) {
							// if(rep == 'OK'){
							//  	alert('Saved');
							// }
							// else{
							//  	alert('Could not be saved. try again.');
							// }
						}
					});
				}
			<?php
		} else {

			?>
				$('#calendario').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,basicWeek,basicDay',
					},
					// defaultView: 'basicWeek',
					// height: 550,
					buttonText: {
						today: '<<'
					},

					navLinks: true, // can click day/week names to navigate views
					editable: false,
					eventLimit: true, // allow "more" link when too many events
					events: [
						<?php foreach ($events as $event) :
							// $desc = enter($event['descricao']);
							$start = explode(" ", $event['start']);
							$end = explode(" ", $event['end']);
							$empresa = chamacampo('empresa', 'nome_fantasia', "WHERE id_empresa='" . $event['empresa'] . "'", $conexao);
							// $titulo = $empresa.' - '.$event['title']; 
							$titulo = '';
							if (!empty($isCliente)) {
								$titulo = $event['nome_usuario'] . ' - ' . $event['title'];
							} else {
								$titulo = $empresa . ' - ' . $event['title'];
							}
							if ($start[1] == '00:00:00') {
								$start = $start[0];
							} else {
								$start = $event['start'];
							}
							if ($end[1] == '00:00:00') {
								$end = $end[0];
							} else {
								$end = $event['end'];
							}
							?> {
								id: '<?php echo $event['id']; ?>',
								id_evento: '<?php echo $event['id_evento']; ?>',
								title: '<?php echo $event['title']; ?>',
								start: '<?php echo $start; ?>',
								end: '<?php echo $end; ?>',
								color: '<?php echo $event['cor_trabalho']; ?>',
								id_usuario: '<?php echo $event['id_usuario']; ?>',

								fechado: '<?php echo $event['fechado']; ?>',
								status: '<?php echo $event['status']; ?>',
								id_linha_produto: '<?php echo $event['id_linha_produto']; ?>',
								empresa: '<?php echo $event['empresa']; ?>',
								cliente: '<?php echo $event['cliente']; ?>',
								tipo_trabalho: '<?php echo $event['tipo_trabalho']; ?>',
								nome_usuario: '<?php echo $event['nome_usuario']; ?>',
								titulo: '<?php echo $titulo; ?>'
							},
						<?php endforeach; ?>
					],
					eventRender: function(event, element) {
						element.find(".fc-title").html(event.titulo);
						if (event.icon) {
							element.find(".fc-title").prepend("<i class='fa " + event.icon + "'> </i> ");
						}
						element.bind('click', function() {
							id_evento = event.id_evento;
							console.log(event);
							$('#ModalVisualizacao #id').val(event.id);
							$('#ModalVisualizacao #title').val(event.title);

							// var regex = /<br\s*[\/]?>/gi;
							// $('#ModalVisualizacao #descricao').html(event.descricao.replace(regex, "\n"));

							$('#ModalVisualizacao #id_usuario').val(event.id_usuario);
							$('#ModalVisualizacao #id_evento').val(event.id_evento);
							$('#ModalVisualizacao #fechado').val(event.fechado);
							$('#ModalVisualizacao #status').val(event.status);
							$('#ModalVisualizacao #linha_produto').val(event.id_linha_produto);
							$('#ModalVisualizacao #empresa').val(event.empresa);
							$('#ModalVisualizacao #cliente').val(event.cliente);
							$('#ModalVisualizacao #tipo_trabalho').val(event.tipo_trabalho);
							$.ajax({
								url: "select-datas.php",
								method: "POST",
								data: {
									id_evento: id_evento
								},
								success: function(data) {
									dataResultado = data.split(',');
									console.log('depois:' + dataResultado);
									//    			$('#ModalVisualizacao #datas_trabalho').multiDatesPicker('resetDates');
									//          $('#ModalVisualizacao #datas_trabalho').multiDatesPicker({
									// 	addDates: dataResultado
									// });
									$('#ModalVisualizacao #datas_trabalho').val(dataResultado);
									// var ta = document.querySelector('#ModalVisualizacao #descricao');
									// autosize(ta);
									// autosize.update(ta);
								}
							});

							$('#ModalVisualizacao #autocompleteUsuario').val(event.nome_usuario);
							// $('#ModalVisualizacao #color').val(event.color);
							$('#ModalVisualizacao').modal('show');
						});
					}
				});

			<?php
		}
		?>
		});
	</script>
	<?php include("../rodape.php") ?>