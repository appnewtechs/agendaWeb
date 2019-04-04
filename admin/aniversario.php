<?php 
require_once "../bootstrap.php";
require "../cabecalho.php";
?>

<?php
if (isset($_SESSION["sucesso"])) {
	echo "<p class='alert-success'>" . $_SESSION["sucesso"] . "</p>";
	unset($_SESSION["sucesso"]);
}
if (isset($_SESSION["danger"])) {
	echo "<p class='alert-danger'>" . $_SESSION["danger"] . "</p>";
	unset($_SESSION["danger"]);
}
?>

<!-- LISTA DADOS JÁ INCLUSOS NO BANCO -->
<div class="col-xs-12 breadcrumb">
    <span>ADMIN > ANIVERSÁRIOS</span>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <div class="panel-body">
        <div class="tab-content">
            <table class="table table-hover" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de Aniversário</th>
                        <th>Usuário/Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
										$datahoje = date("Y-m-d");
										if (!isset($_GET["page"])) {
											$page = "1";
										} else {
											$page = $_GET["page"];
										}
										$aniversarios = ListaAniversariosPaginado($conexao, $page);
										foreach ($aniversarios as $aniversario) {
											$aniversario['nome'] = utf8_encode($aniversario['nome']);
											?>
                    <tr>
                        <td><?= $aniversario['nome']; ?></td>
                        <td><?php if ($aniversario['currbirthday'] >= $datahoje) {
															echo date('d/m', strtotime($aniversario['currbirthday']));
														} else {
															echo date('d/m', strtotime($aniversario['nextbirthday']));
														} ?></td>
                        <td><?= $aniversario['tabela']; ?></td>
                    </tr>
                    <?php

									}
									?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
$limit = 10;
// $sql = "select  from aniversario"
$sql = "SELECT COUNT(*) FROM ( select data_nascimento from usuario union all select data_nascimento from contato ) x";
$rs_result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$pagLink = "<nav><ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
	$pagLink .= "<li><a href='aniversario.php?page=" . $i . "'>" . $i . "</a></li>";
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
            hrefTextPrefix: 'aniversario.php?page=',
            prevText: 'Anterior',
            nextText: 'Próximo'
        });
    });
</script>
<?php include("../rodape.php") ?> 