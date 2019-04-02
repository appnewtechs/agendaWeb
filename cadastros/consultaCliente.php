<?php 

// include('../conecta.php');
define('SERVER', 'localhost');
define('DBNAME', 'newtech');
define('USER', 'root');
define('PASSWORD', 'newtech');
// Recebe os parâmetros enviados via GET
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';
$parametro = (isset($_GET['parametro'])) ? $_GET['parametro'] : '';
$where = "WHERE ";
// Configura uma conexão com o banco de dados
$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
$conexao = new PDO("mysql:host=".SERVER."; dbname=".DBNAME, USER, PASSWORD, $opcoes);

// Verifica se foi solicitado uma consulta para o autocomplete
if($acao == 'autocomplete'):	
	// $where = (!empty($parametro)) ? 'WHERE descricao LIKE ?' : '';
	$sql = "SELECT * FROM `cliente` WHERE `nome_fantasia` LIKE '%".$parametro."%' LIMIT 1";
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$dados = $stm->fetchAll(PDO::FETCH_OBJ);
	$json = json_encode($dados);
	echo $json;
endif;