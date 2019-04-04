<?php 
require_once "../bootstrap.php";
require "../cabecalho.php";
?>

<div class="col-xs-12 breadcrumb">
    <span>ADMIN > USUÁRIOS</span>
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


<style>
    .invisivel {
        display: none !important;
    }

    .visivel {
        display: block;
    }
</style>
<!-- LISTA DADOS JÁ INCLUSOS NO BANCO -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="float: none;">
    <div class="panel-body">
        <div class="tab-content">
            <div id="cadastros" class="tab-pane fade in active">
                <div id="top" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-pages">
                        <?php if ($modo == 1) : ?>
                        <div class="form-group col-xs-6">
                            <a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo" onclick="abrirpopup('../admin/usuario.php?acao=1&id_usuario=0','Usuario');"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <?php endif; ?>
                        <div class="form-group col-xs-6">
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-search"></i>
                                <input type="text" class="form-control" id="busca" placeholder="Informe o usuário..." />
                            </div>
                        </div>
                        <input type="hidden" name="tabela" id="tabela" value="usuario" />
                        <input type="hidden" name="modo" id="modo" value="<?= $modo ?>" />
                        <input type="hidden" name="like" id="like" value="nome,login,email" />
                        <input type="hidden" name="campos" id="campos" value="nome,login,email,telefone,nome_perfil,cor" />
                    </div>
                </div>
            </div>
            <table class="table table-hover default tablesorter">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Usuario</th>
                        <th>Empresa</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Perfil</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!isset($_GET["page"])) {
                        $page = "1";
                    } else {
                        $page = $_GET["page"];
                    }
                    $usuarios = ListaUsuariosPaginado($conexao, $page);
                    if ($modo == 1) :
                        foreach ($usuarios as $usuario) :
                            $usuario['nome'] = utf8_encode($usuario['nome']);
                            $usuario['login'] = utf8_encode($usuario['login']);
                            $usuario['nome_perfil'] = utf8_encode($usuario['nome_perfil']);
                            $empresaNome = chamacampo('empresa', 'nome_fantasia', "WHERE id_empresa='" . $usuario['id_empresa'] . "'", $conexao);
                            $status = 'Ativo';
                            if ($usuario['status'] == 1) :
                                $status = 'Inativo';
                            endif; ?>
                    <tr style="cursor: pointer;" onclick="abrirpopup('../admin/usuario.php?acao=2&id_usuario=<?php echo $usuario['id_usuario']; ?>','Usuario');">
                        <td><?= $usuario['nome']; ?></td>
                        <td><?= $usuario['login']; ?></td>
                        <td><?= $empresaNome; ?></td>
                        <td><?= $usuario['email']; ?></td>
                        <td><?= $usuario['telefone']; ?></td>
                        <td><?= $usuario['nome_perfil']; ?></td>
                        <td><?= $status; ?></td>
                    </tr>
                    <?php 
                endforeach;
            else :
                foreach ($usuarios as $usuario) :
                    $usuario['nome'] = utf8_encode($usuario['nome']);
                    $usuario['login'] = utf8_encode($usuario['login']);
                    $usuario['nome_perfil'] = utf8_encode($usuario['nome_perfil']);
                    $status = 'Ativo';
                    if ($usuario['status'] == 1) {
                        $status = 'Inativo';
                    }
                    ?>
                    <tr>
                        <td><?= $usuario['nome']; ?></td>
                        <td><?= $usuario['login']; ?></td>
                        <td><?= $empresaNome; ?></td>
                        <td><?= $usuario['email']; ?></td>
                        <td><?= $usuario['telefone']; ?></td>
                        <td><?= $usuario['nome_perfil']; ?></td>
                        <td><?= $status; ?></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
                </tbody>
            </table>
            <table class="table table-hover busca">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Usuario</th>
                        <th>Empresa</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Perfil</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="insert">

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$limit = 10;
$sql = "select count(*) from usuario";
$rs_result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$pagLink = "<nav><ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $pagLink .= "<li><a href='usuarios.php?page=" . $i . "'>" . $i . "</a></li>";
}
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
            hrefTextPrefix: 'usuarios.php?page=',
            prevText: 'Anterior',
            nextText: 'Próximo'
        });
    });
</script>
<?php include("../rodape.php"); ?> 