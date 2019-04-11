<?php 

/*******************/
/***** SELECTS *****/

function ListaTiposClientesPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$tipos_clientes = array();
	$query = "select * from tipo_cliente order by codigo desc limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($tipo_cliente = mysqli_fetch_assoc($resultado)) {
		array_push($tipos_clientes, $tipo_cliente);
	}
	return $tipos_clientes;
}

function ListaTiposEmpresasPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$tipos_empresas = array();
	$query = "select * from tipo_empresa order by codigo desc limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($tipo_empresa = mysqli_fetch_assoc($resultado)) {
		array_push($tipos_empresas, $tipo_empresa);
	}
	return $tipos_empresas;
}

function ListaTrabalhosPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$trabalhos = array();
	$query = "select * from trabalho order by codigo desc limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($trabalho = mysqli_fetch_assoc($resultado)) {
		array_push($trabalhos, $trabalho);
	}
	return $trabalhos;
}

function ListaLinhasProdutosPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$linhasProdutos = array();
	$query = "select * from linha_produto order by codigo asc limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($LinhaProduto = mysqli_fetch_assoc($resultado)) {
		array_push($linhasProdutos, $LinhaProduto);
	}
	return $linhasProdutos;
}

function ListaContatosPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$contatos = array();
	$query = "select contato.*, cliente.nome_fantasia FROM `contato` INNER JOIN `cliente` ON contato.id_cliente = cliente.id_cliente order by contato.nome limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($contato = mysqli_fetch_assoc($resultado)) {
		array_push($contatos, $contato);
	}
	return $contatos;
}
function ListaClientesPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$clientes = array();
	$query = "select cliente.*, usuario.login from cliente LEFT JOIN `usuario` ON usuario.id_usuario = cliente.id_usuario order by cliente.razao_social limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($cliente = mysqli_fetch_assoc($resultado)) {
		array_push($clientes, $cliente);
	}
	return $clientes;
}
function ListaEmpresasPaginado($conexao, $page)
{
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$empresas = array();
	$query = "select empresa.*, usuario.login from empresa LEFT JOIN `usuario` ON usuario.id_usuario = empresa.id_usuario order by empresa.razao_social limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($empresa = mysqli_fetch_assoc($resultado)) {
		array_push($empresas, $empresa);
	}
	return $empresas;
}
function buscaClienteId($conexao, $id_cliente)
{
	$query = "select * from cliente where id_cliente = {$id_cliente}";
	$resultado = mysqli_query($conexao, $query);
	$clientes = array();
	while ($cliente = mysqli_fetch_assoc($resultado)) {
		array_push($clientes, $cliente);
	}
	return $clientes[0];
}
function buscaClientesNome($conexao)
{
	$query = "select id_cliente, nome_fantasia from cliente order by nome_fantasia asc";
	$resultado = mysqli_query($conexao, $query);
	$clientes = array();

	$escolha = array(
		"id_cliente" => "",
		"nome_fantasia" => "Escolha um cliente"
	);

	array_push($clientes, $escolha);
	while ($cliente = mysqli_fetch_assoc($resultado)) {
		array_push($clientes, $cliente);
	}
	return $clientes;
}

function buscaEmpresasNome($conexao)
{
	$query = "select id_empresa, nome_fantasia from empresa order by nome_fantasia asc";
	$resultado = mysqli_query($conexao, $query);
	$empresas = array();

	$escolha = array(
		"id_empresa" => "",
		"nome_fantasia" => "Escolha um empresa"
	);

	array_push($empresas, $escolha);
	while ($empresa = mysqli_fetch_assoc($resultado)) {
		// var_dump($empresa);
		array_push($empresas, $empresa);
	}
	return $empresas;
}

function buscaLinhasProdutos($conexao)
{
	$query = "select * from linha_produto order by descricao asc";
	$resultado = mysqli_query($conexao, $query);
	$linhas_produtos = array();

	$escolha = array(
		"id_linha_produto" => "",
		"descricao" => "Escolha uma linha de produto"
	);

	array_push($linhas_produtos, $escolha);
	while ($linha_produto = mysqli_fetch_assoc($resultado)) {
		// var_dump($linha_produto);
		array_push($linhas_produtos, $linha_produto);
	}
	return $linhas_produtos;
}

function buscaTiposCliente($conexao)
{
	$query = "select * from tipo_cliente";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function verificaUsuarioCliente($conexao, $id_usuario)
{
	$query = "select * from cliente where id_usuario = {$id_usuario}";
	$resultado = mysqli_query($conexao, $query);
	$usuarios = array();
	while ($usuario = mysqli_fetch_assoc($resultado)) {
		array_push($usuarios, $usuario);
	}
	return $usuarios;
}

function buscaEmpresasFiltro($conexao)
{
	$query = "select id_empresa, nome_fantasia from empresa order by nome_fantasia asc";
	$resultado = mysqli_query($conexao, $query);
	$empresas = array();
	while ($empresa = mysqli_fetch_assoc($resultado)) {
		array_push($empresas, $empresa);
	}
	return $empresas;
}
function buscaTrabalhoFiltro($conexao)
{
	$query = "select id_trabalho, descricao, cor from trabalho order by descricao asc";
	$resultado = mysqli_query($conexao, $query);
	$trabalhos = array();
	while ($trabalho = mysqli_fetch_assoc($resultado)) {
		array_push($trabalhos, $trabalho);
	}
	return $trabalhos;
}
function buscaLinhasProdutoFiltro($conexao)
{
	$query = "select id_linha_produto, descricao from linha_produto order by descricao asc";
	$resultado = mysqli_query($conexao, $query);
	$linhas = array();
	while ($linha = mysqli_fetch_assoc($resultado)) {
		array_push($linhas, $linha);
	}
	return $linhas;
}
function buscaClientesFiltro($conexao)
{
	$query = "select id_cliente, nome_fantasia from cliente order by nome_fantasia asc";
	$resultado = mysqli_query($conexao, $query);
	$clientes = array();
	while ($cliente = mysqli_fetch_assoc($resultado)) {
		array_push($clientes, $cliente);
	}
	return $clientes;
}
function buscaTiposEmpresa($conexao)
{
	$query = "select * from tipo_empresa";
	$resultado = mysqli_query($conexao, $query);
	$tipos = array();
	while ($tipo = mysqli_fetch_assoc($resultado)) {
		array_push($tipos, $tipo);
	}
	return $tipos;
}

function buscaTrabalhos($conexao)
{
	$query = "select * from trabalho";
	$resultado = mysqli_query($conexao, $query);
	$trabalhos = array();
	$escolha = array(
		"id_trabalho" => "",
		"descricao" => "Escolha um trabalho"
	);

	array_push($trabalhos, $escolha);
	while ($trabalho = mysqli_fetch_assoc($resultado)) {
		array_push($trabalhos, $trabalho);
	}
	return $trabalhos;
}

function buscaContatos($conexao, $id_cliente)
{
	$query = "select * from contato where id_cliente = {$id_cliente}";
	$contatos = array();
	$resultado = mysqli_query($conexao, $query);
	while ($contato = mysqli_fetch_assoc($resultado)) {
		array_push($contatos, $contato);
	}
	return $contatos;
}
function buscaInfoUsuario($conexao, $id_usuario)
{
	$query = "select * from usuario where id_usuario = {$id_usuario}";
	$usuarios = array();
	$resultado = mysqli_query($conexao, $query);
	while ($usuario = mysqli_fetch_assoc($resultado)) {
		array_push($usuarios, $usuario);
	}
	return $usuarios;
}

/*******************/
/***** INSERTS *****/

function insereTipoCliente($conexao, $codigo, $descricao, $cliente_fornecedor)
{
	$descricao = utf8_decode($descricao);
	$cliente_fornecedor = utf8_decode($cliente_fornecedor);

	$query = "insert into tipo_cliente(codigo, descricao, cliente_fornecedor) values('{$codigo}', '{$descricao}', '{$cliente_fornecedor}')";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}
function insereTipoEmpresa($conexao, $codigo, $descricao, $cliente_fornecedor)
{
	$descricao = utf8_decode($descricao);
	$cliente_fornecedor = utf8_decode($cliente_fornecedor);

	$query = "insert into tipo_empresa(codigo, descricao, cliente_fornecedor) values('{$codigo}', '{$descricao}', '{$cliente_fornecedor}')";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function insereTrabalho($conexao, $codigo, $descricao, $cor)
{
	$descricao = utf8_decode($descricao);

	$query = "insert into trabalho(codigo,descricao,cor) values('{$codigo}','{$descricao}','{$cor}')";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function insereLinhaProduto($conexao, $codigo, $descricao)
{
	$descricao = utf8_decode($descricao);
	$query = "insert into linha_produto(codigo, descricao) values('{$codigo}','{$descricao}')";
	var_dump($query);
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function insereContato($conexao, $id_cliente, $nome, $data_nascimento, $telefone, $telefone2, $telefone3, $email, $area_contato, $observacao)
{
	$nome = utf8_decode($nome);
	$descricao = utf8_decode($descricao);
	$area_contato = utf8_decode($area_contato);
	$observacao = utf8_decode($observacao);
	if ($data_nascimento != "") {
		$data_nascimento = str_replace('/', '-', $data_nascimento);
		$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
		$data_nascimento = "'" . $data_nascimento . "'";
	} else {
		$data_nascimento = "NULL";
	}
	$query = "insert into contato(nome, data_nascimento, telefone, telefone2, telefone3, email, area_contato, observacao, id_cliente) values('{$nome}', {$data_nascimento},'{$telefone}','{$telefone2}','{$telefone3}','{$email}', '{$area_contato}','{$observacao}','{$id_cliente}')";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function insereCliente($conexao, $id_tipo_cliente, $prestador_servico, $id_trabalho, $cnpj, $razao_social, $nome_fantasia, $cpf, $endereco, $cep, $estado, $municipio, $complemento, $observacao, $telefone_fixo, $telefone_celular, $id_usuario, $banco, $agencia, $conta, $descricao, $banco_2, $agencia_2, $conta_2, $descricao_2, $banco_3, $agencia_3, $conta_3, $descricao_3, $rg, $data_nascimento, $email)
{
	$razao_social = utf8_decode($razao_social);
	$nome_fantasia = utf8_decode($nome_fantasia);
	$endereco = utf8_decode($endereco);
	$estado = utf8_decode($estado);
	$municipio = utf8_decode($municipio);
	$complemento = utf8_decode($complemento);
	$observacao = utf8_decode($observacao);
	$banco = utf8_decode($banco);
	$descricao = utf8_decode($descricao);
	$banco_2 = utf8_decode($banco_2);
	$descricao_2 = utf8_decode($descricao_2);
	$banco_3 = utf8_decode($banco_3);
	$descricao_3 = utf8_decode($descricao_3);
	$rg = utf8_decode($rg);
	$email = utf8_decode($email);
	if ($data_nascimento != "") {
		$data_nascimento = str_replace('/', '-', $data_nascimento);
		$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
		$data_nascimento = "'" . $data_nascimento . "'";
	} else {
		$data_nascimento = "NULL";
	}
	if ($cnpj != "") {
		$cnpj = "'" . $cnpj . "'";
	} else {
		$cnpj = "NULL";
	}
	if ($id_usuario != 0) {
		$query = "insert into cliente(id_tipo_cliente,prestador_servico,id_trabalho,cnpj,razao_social,nome_fantasia,cpf,endereco,cep,estado,municipio,complemento,observacao,telefone_fixo,telefone_celular,banco,agencia,conta,descricao,banco_2,agencia_2,conta_2,descricao_2,banco_3,agencia_3,conta_3,descricao_3,id_usuario,rg,data_nascimento,email) values('{$id_tipo_cliente}','{$prestador_servico}','{$id_trabalho}',{$cnpj},'{$razao_social}','{$nome_fantasia}','{$cpf}','{$endereco}','{$cep}','{$estado}','{$municipio}','{$complemento}','{$observacao}','{$telefone_fixo}','{$telefone_celular}','{$banco}','{$agencia}','{$conta}','{$descricao}','{$banco_2}','{$agencia_2}','{$conta_2}','{$descricao_2}','{$banco_3}','{$agencia_3}','{$conta_3}','{$descricao_3}','{$id_usuario}','{$rg}',{$data_nascimento},'{$email}')";
	} else {
		$query = "insert into cliente(id_tipo_cliente,prestador_servico,id_trabalho,cnpj,razao_social,nome_fantasia,cpf,endereco,cep,estado,municipio,complemento,observacao,telefone_fixo,telefone_celular,banco,agencia,conta,descricao,banco_2,agencia_2,conta_2,descricao_2,banco_3,agencia_3,conta_3,descricao_3,rg,data_nascimento,email) values('{$id_tipo_cliente}','{$prestador_servico}','{$id_trabalho}',{$cnpj},'{$razao_social}','{$nome_fantasia}','{$cpf}','{$endereco}','{$cep}','{$estado}','{$municipio}','{$complemento}','{$observacao}','{$telefone_fixo}','{$telefone_celular}','{$banco}','{$agencia}','{$conta}','{$descricao}','{$banco_2}','{$agencia_2}','{$conta_2}','{$descricao_2}','{$banco_3}','{$agencia_3}','{$conta_3}','{$descricao_3}','{$rg}',{$data_nascimento},'{$email}')";
	}
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function insereEmpresa($conexao, $id_tipo_empresa, $prestador_servico, $id_trabalho, $cnpj, $razao_social, $nome_fantasia, $cpf, $endereco, $cep, $estado, $municipio, $complemento, $observacao, $telefone_fixo, $telefone_celular, $id_usuario, $banco, $agencia, $conta, $descricao, $banco_2, $agencia_2, $conta_2, $descricao_2, $banco_3, $agencia_3, $conta_3, $descricao_3, $rg, $data_nascimento, $email)
{
	$razao_social = utf8_decode($razao_social);
	$nome_fantasia = utf8_decode($nome_fantasia);
	$endereco = utf8_decode($endereco);
	$estado = utf8_decode($estado);
	$municipio = utf8_decode($municipio);
	$complemento = utf8_decode($complemento);
	$observacao = utf8_decode($observacao);
	$banco = utf8_decode($banco);
	$descricao = utf8_decode($descricao);
	$banco_2 = utf8_decode($banco_2);
	$descricao_2 = utf8_decode($descricao_2);
	$banco_3 = utf8_decode($banco_3);
	$descricao_3 = utf8_decode($descricao_3);
	$rg = utf8_decode($rg);
	$email = utf8_decode($email);
	if ($data_nascimento != "") {
		$data_nascimento = str_replace('/', '-', $data_nascimento);
		$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
		$data_nascimento = "'" . $data_nascimento . "'";
	} else {
		$data_nascimento = "NULL";
	}
	if ($cnpj != "") {
		$cnpj = "'" . $cnpj . "'";
	} else {
		$cnpj = "NULL";
	}
	if ($id_trabalho != "") {
		$id_trabalho = "'" . $id_trabalho . "'";
	} else {
		$id_trabalho = "NULL";
	}

	if ($id_usuario != 0) {
		$query = "insert into empresa(id_tipo_empresa,prestador_servico,id_trabalho,cnpj,razao_social,nome_fantasia,cpf,endereco,cep,estado,municipio,complemento,observacao,telefone_fixo,telefone_celular,banco,agencia,conta,descricao,banco_2,agencia_2,conta_2,descricao_2,banco_3,agencia_3,conta_3,descricao_3,id_usuario,rg,data_nascimento,email) values('{$id_tipo_empresa}','{$prestador_servico}',{$id_trabalho},{$cnpj},'{$razao_social}','{$nome_fantasia}','{$cpf}','{$endereco}','{$cep}','{$estado}','{$municipio}','{$complemento}','{$observacao}','{$telefone_fixo}','{$telefone_celular}','{$banco}','{$agencia}','{$conta}','{$descricao}','{$banco_2}','{$agencia_2}','{$conta_2}','{$descricao_2}','{$banco_3}','{$agencia_3}','{$conta_3}','{$descricao_3}','{$id_usuario}','{$rg}',{$data_nascimento},'{$email}')";
	} else {
		$query = "insert into empresa(id_tipo_empresa,prestador_servico,id_trabalho,cnpj,razao_social,nome_fantasia,cpf,endereco,cep,estado,municipio,complemento,observacao,telefone_fixo,telefone_celular,banco,agencia,conta,descricao,banco_2,agencia_2,conta_2,descricao_2,banco_3,agencia_3,conta_3,descricao_3,rg,data_nascimento,email) values('{$id_tipo_empresa}','{$prestador_servico}',{$id_trabalho},{$cnpj},'{$razao_social}','{$nome_fantasia}','{$cpf}','{$endereco}','{$cep}','{$estado}','{$municipio}','{$complemento}','{$observacao}','{$telefone_fixo}','{$telefone_celular}','{$banco}','{$agencia}','{$conta}','{$descricao}','{$banco_2}','{$agencia_2}','{$conta_2}','{$descricao_2}','{$banco_3}','{$agencia_3}','{$conta_3}','{$descricao_3}','{$rg}',{$data_nascimento},'{$email}')";
	}
	var_dump($query);
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

/*******************/
/***** UPDATES *****/

function alteraTipoCliente($conexao, $id_tipo_cliente, $codigo, $descricao, $cliente_fornecedor)
{
	$descricao = utf8_decode($descricao);
	$cliente_fornecedor = utf8_decode($cliente_fornecedor);
	$query = "update tipo_cliente set codigo = '{$codigo}', descricao = '{$descricao}', cliente_fornecedor = '{$cliente_fornecedor}' WHERE id_tipo_cliente = '{$id_tipo_cliente}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}
function alteraTipoEmpresa($conexao, $id_tipo_empresa, $codigo, $descricao, $cliente_fornecedor)
{
	$descricao = utf8_decode($descricao);
	$cliente_fornecedor = utf8_decode($cliente_fornecedor);
	$query = "update tipo_empresa set codigo = '{$codigo}', descricao = '{$descricao}', cliente_fornecedor = '{$cliente_fornecedor}' WHERE id_tipo_empresa = '{$id_tipo_empresa}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function alteraTrabalho($conexao, $id_trabalho, $codigo, $descricao, $cor)
{
	$descricao = utf8_decode($descricao);
	$query = "update trabalho set descricao = '{$descricao}', codigo = '{$codigo}', cor = '{$cor}' WHERE id_trabalho = '{$id_trabalho}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function alteraLinhaProduto($conexao, $id_linha_produto, $codigo, $descricao)
{
	$descricao = utf8_decode($descricao);
	$query = "update linha_produto set descricao = '{$descricao}', codigo = '{$codigo}' WHERE id_linha_produto = '{$id_linha_produto}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function alteraContato($conexao, $id_cliente, $id_contato, $nome, $data_nascimento, $telefone, $telefone2, $telefone3, $email, $area_contato, $observacao)
{
	$nome = utf8_decode($nome);
	$descricao = utf8_decode($descricao);
	$area_contato = utf8_decode($area_contato);
	$observacao = utf8_decode($observacao);
	if ($data_nascimento != "") {
		$data_nascimento = str_replace('/', '-', $data_nascimento);
		$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
		$data_nascimento = "'" . $data_nascimento . "'";
	} else {
		$data_nascimento = "NULL";
	}
	$query = "update contato set nome = '{$nome}', data_nascimento = {$data_nascimento}, telefone = '{$telefone}', telefone2 = '{$telefone2}', telefone3 = '{$telefone3}', email = '{$email}', area_contato = '{$area_contato}', observacao = '{$observacao}', id_cliente = '{$id_cliente}' WHERE id_contato = '{$id_contato}'";
	var_dump($query);
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function alteraCliente($conexao, $id_cliente, $id_tipo_cliente, $prestador_servico, $id_trabalho, $cnpj, $razao_social, $nome_fantasia, $cpf, $endereco, $cep, $estado, $municipio, $complemento, $observacao, $telefone_fixo, $telefone_celular, $id_usuario, $banco, $agencia, $conta, $descricao, $banco_2, $agencia_2, $conta_2, $descricao_2, $banco_3, $agencia_3, $conta_3, $descricao_3, $rg, $data_nascimento, $email)
{
	$razao_social = utf8_decode($razao_social);
	$nome_fantasia = utf8_decode($nome_fantasia);
	$endereco = utf8_decode($endereco);
	$estado = utf8_decode($estado);
	$municipio = utf8_decode($municipio);
	$complemento = utf8_decode($complemento);
	$observacao = utf8_decode($observacao);
	$banco = utf8_decode($banco);
	$descricao = utf8_decode($descricao);
	$banco_2 = utf8_decode($banco_2);
	$descricao_2 = utf8_decode($descricao_2);
	$banco_3 = utf8_decode($banco_3);
	$descricao_3 = utf8_decode($descricao_3);
	$rg = utf8_decode($rg);
	$email = utf8_decode($email);
	if ($data_nascimento != "") {
		$data_nascimento = str_replace('/', '-', $data_nascimento);
		$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
		$data_nascimento = "'" . $data_nascimento . "'";
	} else {
		$data_nascimento = "NULL";
	}
	if ($cnpj != "") {
		$cnpj = "'" . $cnpj . "'";
	} else {
		$cnpj = "NULL";
	}
	if ($id_usuario != 0) {
		$query = "update cliente set prestador_servico = '{$prestador_servico}', id_trabalho = {$id_trabalho}, id_tipo_cliente = '{$id_tipo_cliente}', cnpj = {$cnpj}, razao_social = '{$razao_social}', nome_fantasia = '{$nome_fantasia}', cpf = '{$cpf}', endereco = '{$endereco}', cep = '{$cep}', estado = '{$estado}', municipio = '{$municipio}', complemento = '{$complemento}', observacao = '{$observacao}', telefone_fixo = '{$telefone_fixo}', telefone_celular = '{$telefone_celular}', banco = '{$banco}', agencia = '{$agencia}', conta = '{$conta}', descricao = '{$descricao}', banco_2 = '{$banco_2}', agencia_2 = '{$agencia_2}', conta_2 = '{$conta_2}', descricao_2 = '{$descricao_2}', banco_3 = '{$banco_3}', agencia_3 = '{$agencia_3}', conta_3 = '{$conta_3}', descricao_3 = '{$descricao_3}', id_usuario = '{$id_usuario}', rg = '{$rg}', email = '{$email}', data_nascimento = {$data_nascimento} WHERE id_cliente = '{$id_cliente}'";
	} else {
		$query = "update cliente set prestador_servico = '{$prestador_servico}', id_trabalho = '{$id_trabalho}', id_tipo_cliente = '{$id_tipo_cliente}', cnpj = {$cnpj}, razao_social = '{$razao_social}', nome_fantasia = '{$nome_fantasia}', cpf = '{$cpf}', endereco = '{$endereco}', cep = '{$cep}', estado = '{$estado}', municipio = '{$municipio}', complemento = '{$complemento}', observacao = '{$observacao}', telefone_fixo = '{$telefone_fixo}', telefone_celular = '{$telefone_celular}', banco = '{$banco}', agencia = '{$agencia}', conta = '{$conta}', descricao = '{$descricao}', banco_2 = '{$banco_2}', agencia_2 = '{$agencia_2}', conta_2 = '{$conta_2}', descricao_2 = '{$descricao_2}', banco_3 = '{$banco_3}', agencia_3 = '{$agencia_3}', conta_3 = '{$conta_3}', descricao_3 = '{$descricao_3}', rg = '{$rg}', email = '{$email}', data_nascimento = {$data_nascimento} WHERE id_cliente = '{$id_cliente}'";
	}
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}


function alteraEmpresa($conexao, $id_empresa, $id_tipo_empresa, $prestador_servico, $id_trabalho, $cnpj, $razao_social, $nome_fantasia, $cpf, $endereco, $cep, $estado, $municipio, $complemento, $observacao, $telefone_fixo, $telefone_celular, $id_usuario, $banco, $agencia, $conta, $descricao, $banco_2, $agencia_2, $conta_2, $descricao_2, $banco_3, $agencia_3, $conta_3, $descricao_3, $rg, $data_nascimento, $email)
{
	$razao_social = utf8_decode($razao_social);
	$nome_fantasia = utf8_decode($nome_fantasia);
	$endereco = utf8_decode($endereco);
	$estado = utf8_decode($estado);
	$municipio = utf8_decode($municipio);
	$complemento = utf8_decode($complemento);
	$observacao = utf8_decode($observacao);
	$banco = utf8_decode($banco);
	$descricao = utf8_decode($descricao);
	$banco_2 = utf8_decode($banco_2);
	$descricao_2 = utf8_decode($descricao_2);
	$banco_3 = utf8_decode($banco_3);
	$descricao_3 = utf8_decode($descricao_3);
	$rg = utf8_decode($rg);
	$email = utf8_decode($email);
	if ($data_nascimento != "") {
		$data_nascimento = str_replace('/', '-', $data_nascimento);
		$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
		$data_nascimento = "'" . $data_nascimento . "'";
	} else {
		$data_nascimento = "NULL";
	}
	if ($cnpj != "") {
		$cnpj = "'" . $cnpj . "'";
	} else {
		$cnpj = "NULL";
	}

	if ($id_trabalho != "") {
		$id_trabalho = "'" . $id_trabalho . "'";
	} else {
		$id_trabalho = "NULL";
	}

	if ($id_usuario != 0) {
		$query = "update empresa set prestador_servico = '{$prestador_servico}', id_trabalho = {$id_trabalho}, id_tipo_empresa = '{$id_tipo_empresa}', cnpj = {$cnpj}, razao_social = '{$razao_social}', nome_fantasia = '{$nome_fantasia}', cpf = '{$cpf}', endereco = '{$endereco}', cep = '{$cep}', estado = '{$estado}', municipio = '{$municipio}', complemento = '{$complemento}', observacao = '{$observacao}', telefone_fixo = '{$telefone_fixo}', telefone_celular = '{$telefone_celular}', banco = '{$banco}', agencia = '{$agencia}', conta = '{$conta}', descricao = '{$descricao}', banco_2 = '{$banco_2}', agencia_2 = '{$agencia_2}', conta_2 = '{$conta_2}', descricao_2 = '{$descricao_2}', banco_3 = '{$banco_3}', agencia_3 = '{$agencia_3}', conta_3 = '{$conta_3}', descricao_3 = '{$descricao_3}', id_usuario = '{$id_usuario}', rg = '{$rg}', email = '{$email}', data_nascimento = {$data_nascimento} WHERE id_empresa = '{$id_empresa}'";
	} else {
		$query = "update empresa set prestador_servico = '{$prestador_servico}', id_trabalho = {$id_trabalho}, id_tipo_empresa = '{$id_tipo_empresa}', cnpj = {$cnpj}, razao_social = '{$razao_social}', nome_fantasia = '{$nome_fantasia}', cpf = '{$cpf}', endereco = '{$endereco}', cep = '{$cep}', estado = '{$estado}', municipio = '{$municipio}', complemento = '{$complemento}', observacao = '{$observacao}', telefone_fixo = '{$telefone_fixo}', telefone_celular = '{$telefone_celular}', banco = '{$banco}', agencia = '{$agencia}', conta = '{$conta}', descricao = '{$descricao}', banco_2 = '{$banco_2}', agencia_2 = '{$agencia_2}', conta_2 = '{$conta_2}', descricao_2 = '{$descricao_2}', banco_3 = '{$banco_3}', agencia_3 = '{$agencia_3}', conta_3 = '{$conta_3}', descricao_3 = '{$descricao_3}', rg = '{$rg}', email = '{$email}', data_nascimento = {$data_nascimento} WHERE id_empresa = '{$id_empresa}'";
	}
	// var_dump($query);
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

/*******************/
/***** DELETES *****/

function removeTipoCliente($conexao, $id_tipo_cliente)
{
	$query = "delete from tipo_cliente where id_tipo_cliente = '{$id_tipo_cliente}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeTipoEmpresa($conexao, $id_tipo_empresa)
{
	$query = "delete from tipo_empresa where id_tipo_empresa = '{$id_tipo_empresa}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeTrabalho($conexao, $id_trabalho)
{
	$query = "delete from trabalho where id_trabalho = '{$id_trabalho}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeEmpresa($conexao, $id_empresa)
{
	$query = "delete from empresa where id_empresa = '{$id_empresa}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeLinhaProduto($conexao, $id_linha_produto)
{
	$query = "delete from linha_produto where id_linha_produto = '{$id_linha_produto}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeContato($conexao, $id_contato)
{
	$query = "delete from contato where id_contato = '{$id_contato}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeCliente($conexao, $id_cliente)
{
	$query = "delete from cliente where id_cliente = '{$id_cliente}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}
