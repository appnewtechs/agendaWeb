<?php
require_once "../bootstrap.php";
require "../cabecalho.php";
?>
<script>
window.USUARIO = { id: "<?php echo $usuarioLogado["id_usuario"] ?>" }
</script>
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

function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}

$dados = [
	"tipos_empresa" => utf8_converter($tipos_empresa),
	"filtro_empresa" => utf8_converter($filtro_empresa),
	"filtro_trabalho" => utf8_converter($filtro_trabalho),
	"filtro_cliente" => utf8_converter($filtro_cliente),
	"filtro_linha_produto" => utf8_converter($filtro_linha_produto),
	"usuarios_select" => utf8_converter($usuarios_select),
	"empresas_select" => utf8_converter($empresas_select),
	"clientes_select" => utf8_converter($clientes_select),
	"linha_produtos_select" => utf8_converter($linha_produtos_select),
	"tipos_trabalho_select" => utf8_converter($tipos_trabalho_select),
	"usuarios" => utf8_converter($usuarios),
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

<script src="<?php echo $base_url; ?>/js/vendor9.js"></script>
<script src="<?php echo $base_url; ?>/js/app9.js"></script>