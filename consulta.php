<?php 
require_once ('../bootstrap.php');
// Recebe os parâmetros enviados via GET
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';
$parametro = (isset($_GET['parametro'])) ? $_GET['parametro'] : '';
$tabela = (isset($_GET['tabela'])) ? $_GET['tabela'] : '';
$like = (isset($_GET['like'])) ? $_GET['like'] : '';
$like = explode(",", $like);
$where = "WHERE ";
// Configura uma conexão com o banco de dados
$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
$conexao = new PDO("mysql:host=".DB_SERVER."; dbname=".DB_NAME, DB_USER, DB_PASSWORD, $opcoes);


if(!empty($parametro)){
	$count = count($like);
	$count = $count - 1;
	foreach ($like as $key => $campo) {
		if($count == $key){
			$where .= $campo." LIKE ?";
		}else{
			$where .= $campo." LIKE ? OR ";
		}
	}
}

// Verifica se foi solicitado uma consulta para o autocomplete
if($acao == 'autocomplete'):	
	// $where = (!empty($parametro)) ? 'WHERE descricao LIKE ?' : '';
	$sql = "SELECT * FROM ". $tabela. " " . $where;
	$stm = $conexao->prepare($sql);
	$count = count($like);
	for ($i=1; $i <= $count ; $i++) { 
		$stm->bindValue($i, '%'.$parametro.'%');
	}
	// var_dump($stm);	
	$stm->execute();
	$dados = $stm->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;
endif;

// Verifica se foi solicitado uma consulta para preencher os campos do formulário
if($acao == 'consulta'):
	$dados = array();
	if($tabela != 'contato' && $tabela != 'usuario'){
		$sql = "SELECT * FROM ".$tabela. " ".$where." LIMIT 1";
		$stm = $conexao->prepare($sql);
		$count = count($like);
		for ($i=1; $i <= $count ; $i++) { 
			$stm->bindValue($i, '%'.$parametro.'%');
		}
		$stm->execute();
		$dados = $stm->fetchAll(PDO::FETCH_OBJ);

	}else if($tabela == 'contato'){
		$sql = "select contato.*, cliente.nome_fantasia FROM `contato` INNER JOIN `cliente` ON contato.id_cliente = cliente.id_cliente WHERE contato.nome LIKE ? LIMIT 1";
		$stm = $conexao->prepare($sql);
		$stm->bindValue(1, $parametro.'%');
		$stm->execute();
		$dados = $stm->fetchAll(PDO::FETCH_OBJ);

	}else if($tabela == 'usuario'){
		$sql = "select * from usuario where nome LIKE ? LIMIT 1";
		$stm = $conexao->prepare($sql);
		$count = count($like);
		$stm->bindValue(1, $parametro.'%');
		// for ($i=1; $i <= $count ; $i++) { 
		// }
		$stm->execute();
		$dados = $stm->fetchAll(PDO::FETCH_OBJ);
		$conexao = mysqli_connect("newtech-mysql","root","","newtech");
		$query_perfil = "select usuario_perfil.id_usuario,usuario_perfil.id_perfil,perfil.nome FROM `usuario_perfil` INNER JOIN `perfil` ON usuario_perfil.id_perfil = perfil.id_perfil WHERE usuario_perfil.id_usuario = ".$dados[0]->id_usuario;
		$dados[0]->nome_perfil = "";
		$resultado_perfil = mysqli_query($conexao, $query_perfil);
		$numResults = mysqli_num_rows($resultado_perfil);
		$counter = 0;
		while ($perfil = mysqli_fetch_assoc($resultado_perfil)) {
			if (++$counter == $numResults) {
		        // last row
		    	$dados[0]->nome_perfil .= $perfil['nome'];	
		    } else {
		        // not last row
				$dados[0]->nome_perfil .= $perfil['nome']."/"; 
		    }
		}
	}
	$json = json_encode($dados);
	echo $json;
endif;