<?php 
require_once "../bootstrap.php";
require "../cabecalho.php";
?>

<div class="col-xs-12 breadcrumb">
    <span>ADMIN > PERFIL</span>
</div>
<?php
if (isset($_SESSION["sucesso"])) {
	echo "<p class='alert-success'>" . $_SESSION["sucesso"] . "</p>";
	unset($_SESSION["sucesso"]);
}
if (isset($_SESSION["danger"])) {
	echo "<p class='alert-danger'>" . $_SESSION["danger"] . "</p>";
	unset($_SESSION["danger"]);
}
function searchForId($id, $array)
{
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
            <?php if ($modo == 1) { ?>
            <div id="cadastros" class="tab-pane fade in active">
                <div id="top" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" data-toggle="modal" data-target=".bs-perfil-modal-lg"><i class="glyphicon glyphicon-plus"></i></a>
                    </div>
                </div>
            </div>
            <?php 
					} ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Rotinas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
										if (!isset($_GET["page"])) {
											$page = "1";
										} else {
											$page = $_GET["page"];
										}
										$perfis = ListaPerfisPaginado($conexao, $page);
										if ($modo == 1) {
											foreach ($perfis as $perfil) {
												$perfil['nome'] = utf8_encode($perfil['nome']);
												$perfil['descricao'] = utf8_encode($perfil['descricao']);
												$perfil['rotinas'] = utf8_encode($perfil['rotinas']);
												?>
                    <tr data-toggle="modal" data-target=".bs-perfil-alterar-modal-lg-<?php echo $perfil['id_perfil']; ?>">
                        <td><?= $perfil['nome']; ?></td>
                        <td><?= $perfil['descricao']; ?></td>
                        <td><?= $perfil['rotinas']; ?></td>
                    </tr>
                    <?php

									}
								} else {
									foreach ($perfis as $perfil) {
										$perfil['nome'] = utf8_encode($perfil['nome']);
										$perfil['descricao'] = utf8_encode($perfil['descricao']);
										$perfil['rotinas'] = utf8_encode($perfil['rotinas']);
										?>
                    <tr>
                        <td><?= $perfil['nome']; ?></td>
                        <td><?= $perfil['descricao']; ?></td>
                        <td><?= $perfil['rotinas']; ?></td>
                    </tr>
                    <?php

									}
								}
								?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL PARA CADASTRO DE NOVO PERFIL -->
<div class="modal fade bs-perfil-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Perfil</h4>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <form class="form-horizontal formulario0" action="adiciona-perfil.php" method="post">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label required">Nome</label>
                                                <input type="text" class="form-control" name="nome" placeholder="Nome" required="true" autofocus>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label required">Descrição</label>
                                                <input type="text" class="form-control" name="descricao" placeholder="Descrição" required="true">
                                            </div>
                                        </div>
                                        <?php 
																				$rotinas = buscaRotinas($conexao);
																				?>
                                        <div class="row">
                                            <table class="table-rotina">
                                                <thead>
                                                    <tr>
                                                        <th>Rotina</th>
                                                        <th>Edição</th>
                                                        <th>Visualização</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
																										foreach ($rotinas as $key => $rotina) {
																											$rotina['nome'] = utf8_encode($rotina['nome']);
																											?>
                                                    <tr>
                                                        <td><?= $rotina['nome']; ?></td>
                                                        <td><input type="checkbox" class="form-control" name="edicao<?= $key; ?>" value="1"></td>
                                                        <td><input type="checkbox" class="form-control" name="visualizacao<?= $key; ?>" value="1"></td>
                                                    </tr>
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

<!-- MODAL PARA ALTERAÇÃO DE PERFIL -->
<?php foreach ($perfis as $key => $perfil) {
	$perfil['nome'] = utf8_encode($perfil['nome']);
	$perfil['descricao'] = utf8_encode($perfil['descricao']); ?>
<div class="modal fade bs-perfil-alterar-modal-lg-<?php echo $perfil['id_perfil']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Cadastro de Novo Perfil</h4>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <form class="form-horizontal formulario<?= $key + 1 ?>" action="altera-perfil.php" method="post">
                                        <input type="hidden" name="id_perfil" value="<?= $perfil['id_perfil'] ?>" />
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label class="col-form-label">Codigo</label>
                                                <input disabled class="form-control" value="<?= $perfil['id_perfil']; ?>" type="text" name="id_perfil" id="id_perfil" required="true">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="col-form-label required">Nome</label>
                                                <input type="text" class="form-control" value="<?= $perfil['nome']; ?>" name="nome" required="true" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="col-form-label required">Descrição</label>
                                                <input type="text" class="form-control" value="<?= $perfil['descricao']; ?>" name="descricao" required="true">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table-rotina">
                                                <thead>
                                                    <tr>
                                                        <th>Rotina</th>
                                                        <th>Edição</th>
                                                        <th>Visualização</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
																										foreach ($rotinas as $key => $rotina) {
																											$perfil['nome'] = utf8_encode($perfil['nome']);
																											$perfil['descricao'] = utf8_encode($perfil['descricao']);
																											?>
                                                    <tr>
                                                        <td><?= $rotina['nome']; ?></td>
                                                        <?php 
																												$esconde = 0;
																												foreach ($perfil['rotinasPerfil'] as $key2 => $value) {
																													if ($rotina['nome'] == $value['nome']) {
																														$esconde = 1;
																														if ($value['edicao'] == 1) {
																															?>
                                                        <td><input type="checkbox" checked class="form-control" name="edicao<?= $key; ?>" value="1"></td>
                                                        <?php

																											} else {
																												?>
                                                        <td><input type="checkbox" class="form-control" name="edicao<?= $key; ?>" value="1"></td>
                                                        <?php

																											}
																											if ($value['visualizacao'] == 1) {
																												?>
                                                        <td><input type="checkbox" checked class="form-control" name="visualizacao<?= $key; ?>" value="1"></td>
                                                        <?php

																											} else {
																												?>
                                                        <td><input type="checkbox" class="form-control" name="visualizacao<?= $key; ?>" value="1"></td>
                                                        <?php

																											}
																										}
																									}
																									if ($esconde == 0) {
																										?>
                                                        <td><input type="checkbox" class="form-control" name="edicao<?= $key; ?>" value="1"></td>
                                                        <td><input type="checkbox" class="form-control" name="visualizacao<?= $key; ?>" value="1"></td>
                                                        <?php 
																											}
																											$esconde = 0; ?>
                                                    </tr>
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
                                    </form>
                                </div>
                            </div>

                            <form action="remove-perfil.php" method="POST" name="form_exclusao_perfil">
                                <input type="hidden" name="id_perfil" value="<?= $perfil['id_perfil'] ?>" />
                                <button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn-excluir">Excluir Perfil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
} ?>

<?php 
$limit = 10;
$sql = "select count(*) from perfil";
$rs_result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$pagLink = "<nav><ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
	$pagLink .= "<li><a href='perfil.php?page=" . $i . "'>" . $i . "</a></li>";
};
echo $pagLink . "</ul></nav>";
?>
<script>
    $(document).ready(function() {
        $('.pre-selected-options').multiSelect();
        $('.pagination').pagination({
            items: <?php echo $total_records; ?>,
            itemsOnPage: <?php echo $limit; ?>,
            cssStyle: 'light-theme',
            currentPage: <?php echo $page; ?>,
            hrefTextPrefix: 'perfil.php?page=',
            prevText: 'Anterior',
            nextText: 'Próximo'
        });
    });
</script>
<?php include("../rodape.php") ?> 