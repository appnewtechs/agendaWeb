<?php 

include('conecta.php');

function ListaFichaTrabalhoPaginado($conexao, $page){
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$fichas = array();
	$query = "select * from ficha_trabalho limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($ficha = mysqli_fetch_assoc($resultado)) {
		array_push($fichas, $ficha);
	}
	return $fichas;
}

function ListaOrcamentoPaginado($conexao, $page){
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$fichas = array();
	// $query = "select * from orcamento limit {$offset},{$items_per_page}";
	$query = "select orcamento.*, ficha_trabalho.job FROM `orcamento` INNER JOIN `ficha_trabalho` ON orcamento.id_ficha_trabalho = ficha_trabalho.id_ficha_trabalho order by orcamento.data_entrada limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($ficha = mysqli_fetch_assoc($resultado)) {
		array_push($fichas, $ficha);
	}
	return $fichas;
}

function buscaFichaTrabalho($conexao){
	$query ="select * from ficha_trabalho order by id_ficha_trabalho asc";
	$resultado = mysqli_query($conexao, $query);
	$fichastrabalho = array();
	while ($ficha_trabalho = mysqli_fetch_assoc($resultado)) {
		array_push($fichastrabalho, $ficha_trabalho);
	}
	return $fichastrabalho;
}

function buscaOrcamento($conexao){
	$query ="select * from orcamento order by id_orcamento asc";
	$resultado = mysqli_query($conexao, $query);
	$fichastrabalho = array();
	while ($ficha_trabalho = mysqli_fetch_assoc($resultado)) {
		array_push($fichastrabalho, $ficha_trabalho);
	}
	return $fichastrabalho;
}

function buscaContatoCliente($conexao, $id_cliente){
	$query = "select * from contato where id_cliente = {$id_cliente}";
	$resultado = mysqli_query($conexao, $query);
	$contatos = array();
	while ($contato = mysqli_fetch_assoc($resultado)) {
		array_push($contatos, $contato);
	}
	return $contatos;	
}

function buscaFichaTrabalhoStatus($conexao,$status){
	$query = "SELECT * FROM ficha_trabalho WHERE status = '{$status}' order by id_ficha_trabalho asc";
	$resultado = mysqli_query($conexao, $query);
	$fichastrabalho = array();
	$escolha = array(
	 "id_ficha_trabalho"=> "",
	 "job"=> "Escolha uma ficha de trabalho"
	);
	array_push($fichastrabalho, $escolha);
	while ($ficha_trabalho = mysqli_fetch_assoc($resultado)) {
		array_push($fichastrabalho, $ficha_trabalho);
	}
	return $fichastrabalho;
}

/*******************/
/***** INSERTS *****/


function insereFichaTrabalho($conexao, $cliente, $trabalho, $status, $job, $solicitante, $data_entrada, $agente, $contato, $telefone, $email, $contato_contabilidade, $observacao){
	// var_dump($data_entrada);
	$data_entrada = str_replace('/', '-', $data_entrada);
	$data_entrada = date('Y/m/d', strtotime($data_entrada));
	$query = "insert into ficha_trabalho(id_cliente, id_trabalho, status, job, solicitante, data_entrada, agente, contato, telefone, email, contato_contabilidade, observacao) values('{$cliente}', '{$trabalho}', '{$status}', '{$job}', '{$solicitante}', '{$data_entrada}','{$agente}', '{$contato}', '{$telefone}', '{$email}', '{$contato_contabilidade}', '{$observacao}')";
	// var_dump($query);
	$resultado = mysqli_query($conexao, $query);	
	return $resultado;
}

function insereOrcamento($conexao, $id_ficha_trabalho, $status, $data_entrada){
	// var_dump($data_entrada);
	$data_entrada = str_replace('/', '-', $data_entrada);
	$data_entrada = date('Y/m/d', strtotime($data_entrada));
	$queryFicha = "update ficha_trabalho set status = 'Em Orçamento' where id_ficha_trabalho = '{$id_ficha_trabalho}'";
	$resultadoFicha = mysqli_query($conexao, $queryFicha);
	$query = "insert into orcamento(id_ficha_trabalho, status, data_entrada) values('{$id_ficha_trabalho}', 'Aberto', '{$data_entrada}')";
	// var_dump($query);
	$resultado = mysqli_query($conexao, $query);	
	return $resultado;
}

function returnLastID($conexao){
	$id = mysqli_insert_id($conexao);
	return $id;
}

/*******************/
/***** UPDATES *****/

function alteraFichaTrabalho($conexao, $id_ficha_trabalho, $cliente, $trabalho, $status, $job, $solicitante, $data_entrada, $agente, $contato, $telefone, $email, $contato_contabilidade, $observacao, $endereco_trabalho, $vencimento, $info_job){
	$data_entrada = str_replace('/', '-', $data_entrada);
	$data_entrada = date('Y/m/d', strtotime($data_entrada));
	// $vencimento = str_replace('/', '-', $vencimento);
	// $vencimento = date('Y/m/d', strtotime($vencimento));
	if($vencimento != ""){
	$vencimento = str_replace('/', '-', $vencimento);
	$vencimento = date('Y/m/d', strtotime($vencimento));
			$vencimento = "'".$vencimento."'";
	}else{
		$vencimento = "NULL";
	}

		$query = "update ficha_trabalho set id_cliente = '{$cliente}', id_trabalho = '{$trabalho}', status = '{$status}', job = '{$job}', solicitante = '{$solicitante}', data_entrada = '{$data_entrada}', agente = '{$agente}', contato = '{$contato}', telefone = '{$telefone}', email = '{$email}', contato_contabilidade = '{$contato_contabilidade}', observacao = '{$observacao}', endereco_trabalho = '{$endereco_trabalho}', vencimento = {$vencimento}, info_job = '{$info_job}' where id_ficha_trabalho = '{$id_ficha_trabalho}'";

	// var_dump($query);
		$queryOrcamento = "SELECT * FROM orcamento WHERE id_ficha_trabalho = '{$id_ficha_trabalho}'";
		$resultadoOrcamento = mysqli_query($conexao, $queryOrcamento);
		if($resultadoOrcamento){
			$queryOrcamento = "UPDATE orcamento SET data_entrada = '{$data_entrada}' WHERE id_ficha_trabalho = '{$id_ficha_trabalho}'";
			$resultadoOrcamento = mysqli_query($conexao, $queryOrcamento);
		}
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function alteraOrcamento($conexao, $id_orcamento, $id_ficha_trabalho, $status, $voucher, $data_entrada, $data_aprovacao, $taxa_produtora, $percentual_taxa_produtora, $eventuais, $percentual_eventuais, $impostos, $percentual_impostos, $comissao, $percentual_comissao, $nota, $orcamento){
	$data_entrada = str_replace('/', '-', $data_entrada);
	$data_entrada = date('Y/m/d', strtotime($data_entrada));
	if($data_aprovacao!=""){
		$data_aprovacao = str_replace('/', '-', $data_aprovacao);
		$data_aprovacao = date('Y/m/d', strtotime($data_aprovacao));
		if($status == "Aberto"){
			$status = "Em Fechamento";
		}
	}else{
		$data_aprovacao = null;
	}
	// if($executado==""){$executado=0;}
	if($percentual_eventuais==""){$percentual_eventuais=0;}
	if($percentual_taxa_produtora==""){$percentual_taxa_produtora=0;}
	if($percentual_impostos==""){$percentual_impostos=0;}
	if($percentual_comissao==""){$percentual_comissao=0;}
	if($eventuais=="" || $eventuais=="NaN"){$eventuais=0;}
	if($taxa_produtora=="" || $taxa_produtora=="NaN"){$taxa_produtora=0;}
	if($impostos=="" || $impostos=="NaN"){$impostos=0;}
	if($comissao=="" || $comissao=="NaN"){$comissao=0;}
	if($nota=="" || $nota=="NaN"){$nota=0;}
	if($data_aprovacao==null){
		$query = "update orcamento set id_ficha_trabalho = '{$id_ficha_trabalho}', status = '{$status}', voucher = '{$voucher}', data_entrada = '{$data_entrada}', data_aprovacao = null, taxa_produtora = '{$taxa_produtora}', percentual_taxa_produtora = '{$percentual_taxa_produtora}', eventuais = '{$eventuais}', percentual_eventuais = '{$percentual_eventuais}', impostos = '{$impostos}', percentual_impostos = '{$percentual_impostos}', comissao = '{$comissao}', percentual_comissao = '{$percentual_comissao}', nota = '{$nota}', orcamento = '{$orcamento}' where id_orcamento = '{$id_orcamento}'";
	}else{
	$query = "update orcamento set id_ficha_trabalho = '{$id_ficha_trabalho}', status = '{$status}', voucher = '{$voucher}', data_entrada = '{$data_entrada}', data_aprovacao = '{$data_aprovacao}', taxa_produtora = '{$taxa_produtora}', percentual_taxa_produtora = '{$percentual_taxa_produtora}', eventuais = '{$eventuais}', percentual_eventuais = '{$percentual_eventuais}', impostos = '{$impostos}', percentual_impostos = '{$percentual_impostos}', comissao = '{$comissao}', percentual_comissao = '{$percentual_comissao}', nota = '{$nota}', orcamento = '{$orcamento}' where id_orcamento = '{$id_orcamento}'";
	}
	// var_dump($query);
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

/*******************/
/***** DELETES *****/

function removeFichaTrabalho($conexao, $id_ficha_trabalho){
	$queryOI = "select * from orcamento where id_ficha_trabalho = '{$id_ficha_trabalho}'";
	$resultadoOI = mysqli_query($conexao, $queryOI);
	while ($orcamento = mysqli_fetch_assoc($resultadoOI)) {
		removeOrcamento($conexao,$orcamento['id_orcamento'],$id_ficha_trabalho);
	}
	$queryAG = "select * from empresa_ficha where id_ficha_trabalho = '{$id_ficha_trabalho}'";
	$resultadoAG = mysqli_query($conexao, $queryAG);
	while ($empresa = mysqli_fetch_assoc($resultadoAG)) {
		$id_empresa_ficha = $empresa['id_empresa_ficha'];
		$queryDeleteEvents = "DELETE from events where id_empresa_ficha = '{$id_empresa_ficha}'";
		$resultadoDeleteEvents = mysqli_query($conexao, $queryDeleteEvents);
		$queryDeleteAG = "DELETE from empresa_ficha where id_empresa_ficha = '{$id_empresa_ficha}'";
		$resultadoDeleteAG = mysqli_query($conexao, $queryDeleteAG);
	}	
	$query = "delete from ficha_trabalho where id_ficha_trabalho = '{$id_ficha_trabalho}'";
	var_dump($query);
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}
function removeOrcamento($conexao, $id_orcamento, $id_ficha_trabalho){
	$queryOI = "delete from orcamento_item where id_orcamento = '{$id_orcamento}'";
	$resultadoOI = mysqli_query($conexao, $queryOI);
	$query = "delete from orcamento where id_orcamento = '{$id_orcamento}'";
	$resultado = mysqli_query($conexao, $query);

	$queryFicha = "update ficha_trabalho set status = 'Aberto' where id_ficha_trabalho = '{$id_ficha_trabalho}'";
	// var_dump($queryFicha);
	$resultadoFicha = mysqli_query($conexao, $queryFicha);

	return $resultado;
}