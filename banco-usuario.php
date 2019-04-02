<?php

include('conecta.php');

/*******************/
/***** SELECTS *****/

function login($conexao, $login, $senha){
	$senhaMd5 = md5($senha);
	$query ="select * from usuario where login ='{$login}' and senha='{$senhaMd5}'";
	$resultado = mysqli_query($conexao, $query);
	$usuario = mysqli_fetch_assoc($resultado);
	return $usuario;
}

function buscaUsuario($conexao, $login){
	$query ="select * from usuario where login ='{$login}'";
	$resultado = mysqli_query($conexao, $query);
	$usuario = mysqli_fetch_assoc($resultado);
	return $usuario;
}

function buscaUsuarios($conexao){
	$query ="select * from usuario where status = 0 order by nome asc";
	$resultado = mysqli_query($conexao, $query);
	$usuarios = array();
	while ($usuario = mysqli_fetch_assoc($resultado)) {
		array_push($usuarios, $usuario);
	}
	return $usuarios;
}
function buscaUsuariosOrder($conexao,$order){
	// $query ="select * from usuario order by $order asc, especialidade asc, nome asc";
	$query = "select usuario.*, linha_produto.descricao from usuario inner join linha_produto on usuario.id_linha_produto = linha_produto.id_linha_produto where usuario.status = 0 order by linha_produto.descricao asc, usuario.especialidade asc, usuario.nome asc";
	$resultado = mysqli_query($conexao, $query);
	$usuarios = array();
	while ($usuario = mysqli_fetch_assoc($resultado)) {
		array_push($usuarios, $usuario);
	}
	return $usuarios;
}


function buscaUsuariosNome($conexao){
	$query ="select * from usuario order by nome asc";
	$resultado = mysqli_query($conexao, $query);
	$usuarios = array();
	$escolhatext = utf8_decode("Escolha um usuário");
	$escolha = array(
	 "id_usuario"=> "",
	 "nome"=> $escolhatext
	);

	array_push($usuarios, $escolha);
	while ($usuario = mysqli_fetch_assoc($resultado)) {
		array_push($usuarios, $usuario);
	}
	return $usuarios;
}

function buscaTiposTrabalho($conexao){
	$query ="select * from trabalho order by descricao asc";
	$resultado = mysqli_query($conexao, $query);
	$tiposTrabalho = array();
	$escolhatext = utf8_decode("Escolha um tipo de trabalho");
	$escolha = array(
	 "id_trabalho"=> "",
	 "descricao"=> $escolhatext
	);

	array_push($tiposTrabalho, $escolha);
	while ($tipoTrabalho = mysqli_fetch_assoc($resultado)) {
		array_push($tiposTrabalho, $tipoTrabalho);
	}
	return $tiposTrabalho;
}

function buscaRotinas($conexao){
	$query = "select * from rotina";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function buscaPerfis($conexao){
	$query = "select * from perfil";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function buscaPerfil($conexao, $nome, $id_perfil){
	$query = "select * from perfil where id_perfil = {$id_perfil}";
	$resultado = mysqli_query($conexao, $query);
	$ok = 0;
	while ($cliente = mysqli_fetch_assoc($resultado)) {
		if($cliente['nome'] != $nome){$ok=1;}
	}
	if($ok == 1){
		$query = "select * from perfil where nome = '{$nome}' limit 1";
		$resultado = mysqli_query($conexao, $query);
		return $resultado->num_rows;
	}else{
		return 0;
	}
}

function buscaRotinaUsuario($conexao, $id_usuario){
	$query ="select id_perfil from usuario_perfil where id_usuario ='{$id_usuario}'";
	$perfis = array();
	if ($resultado = mysqli_query($conexao, $query)) {
	    while ($row = $resultado->fetch_assoc()) {
	        array_push($perfis, $row['id_perfil']);
	    }
	    $resultado->close();
	}
	$ids = join("','",$perfis);
	$query = "select * from perfil_rotina where id_perfil in ('$ids')";
	$rotinas = array();
	if ($resultado = mysqli_query($conexao, $query)) {
	    while ($row = $resultado->fetch_assoc()) {
	        array_push($rotinas, $row['id_rotina']);
	    }
	    $resultado->close();
	}
	return $rotinas;
}
function buscaRotinaUsuarioPermissoes($conexao, $id_usuario){
	$query ="select id_perfil from usuario_perfil where id_usuario ='{$id_usuario}'";
	$perfis = array();
	if ($resultado = mysqli_query($conexao, $query)) {
	    while ($row = $resultado->fetch_assoc()) {
	        array_push($perfis, $row['id_perfil']);
	    }
	    $resultado->close();
	}
	$ids = join("','",$perfis);
	$query = "select * from perfil_rotina where id_perfil in ('$ids')";
	$rotinas = array();
	if ($resultado = mysqli_query($conexao, $query)) {
	    while ($row = $resultado->fetch_assoc()) {
	        array_push($rotinas, $row);
	    }
	    $resultado->close();
	}
	return $rotinas;
}
function ListaUsuariosPaginado($conexao, $page){
	$titulos = array();
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$usuarios = array();
	$query_usuario = "select * from usuario limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query_usuario);
	while ($usuario = mysqli_fetch_assoc($resultado)) {
		$query_perfil = "select usuario_perfil.id_usuario,usuario_perfil.id_perfil,perfil.nome FROM `usuario_perfil` INNER JOIN `perfil` ON usuario_perfil.id_perfil = perfil.id_perfil WHERE usuario_perfil.id_usuario = {$usuario['id_usuario']}";
		$usuario['nome_perfil'] = "";
		$resultado_perfil = mysqli_query($conexao, $query_perfil);
		$numResults = mysqli_num_rows($resultado_perfil);
		$counter = 0;
		while ($perfil = mysqli_fetch_assoc($resultado_perfil)) {
			if (++$counter == $numResults) {
		        // last row
		    	$usuario['nome_perfil'] .= $perfil['nome'];
		    } else {
		        // not last row
				$usuario['nome_perfil'] .= $perfil['nome']."/";
		    }
		}
		array_push($usuarios, $usuario);
	}
	return $usuarios;
}

function ListaPerfisPaginado($conexao, $page){
	$titulos = array();
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$perfis = array();
	$query_usuario = "select * from perfil limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query_usuario);
	while ($perfil = mysqli_fetch_assoc($resultado)) {
		$query_perfil_rotina = "select rotina.id_rotina, rotina.nome, perfil_rotina.edicao, perfil_rotina.visualizacao FROM `perfil_rotina` INNER JOIN `rotina` ON perfil_rotina.id_rotina = rotina.id_rotina WHERE perfil_rotina.id_perfil = {$perfil['id_perfil']}";
		$perfil['rotinas'] = "";
		$perfil['rotinasPerfil'] = array();
		$resultado_perfil_rotina = mysqli_query($conexao, $query_perfil_rotina);
		$numResults = mysqli_num_rows($resultado_perfil_rotina);
		$counter = 0;
		while ($rotina = mysqli_fetch_assoc($resultado_perfil_rotina)) {
			if (++$counter == $numResults) {
		        // last row
		    	$perfil['rotinas'] .= $rotina['nome'];
		    } else {
		        // not last row
				$perfil['rotinas'] .= $rotina['nome']."/";
		    }
			array_push($perfil['rotinasPerfil'], $rotina);
		}
		array_push($perfis, $perfil);
	}
	return $perfis;
}

function ListaFrasesPaginado($conexao, $page){
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$frases = array();
	$query = "select * from frase limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query);
	while ($frase = mysqli_fetch_assoc($resultado)) {
		array_push($frases, $frase);
	}
	return $frases;
}

function ListaAniversariosPaginado($conexao, $page){
	$titulos = array();
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;
	$aniversarios = array();
	$query_usuario = "SELECT
	nome,
	'Usuário' as tabela,
	data_nascimento,
	data_nascimento + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(data_nascimento)) + 0 YEAR AS currbirthday,
	data_nascimento + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(data_nascimento)) + 1 YEAR AS nextbirthday
	FROM usuario
	UNION
	SELECT
	nome,
	'Cliente' as tabela,
	data_nascimento,
	data_nascimento + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(data_nascimento)) + 0 YEAR AS currbirthday, data_nascimento + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(data_nascimento)) + 1 YEAR AS nextbirthday
	FROM contato ORDER BY CASE WHEN currbirthday >= CURRENT_TIMESTAMP THEN currbirthday ELSE nextbirthday END limit {$offset},{$items_per_page}";
	$resultado = mysqli_query($conexao, $query_usuario);
	while ($aniversario = mysqli_fetch_assoc($resultado)) {
		array_push($aniversarios, $aniversario);
	}
	return $aniversarios;
}

/*******************/
/***** INSERTS *****/

function insereUsuario($conexao, $login, $senha, $nome, $data_nascimento, $email, $telefone, $perfis, $cor, $imagem, $id_linha_produto, $id_empresa, $especialidade){
	$senhaMd5 = md5($senha);
	$login = utf8_decode($login);
	$nome = utf8_decode($nome);
	$especialidade = utf8_decode($especialidade);
	$query = "";

	if($data_nascimento != ""){
	$data_nascimento = str_replace('/', '-', $data_nascimento);
	$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
			$data_nascimento = "'".$data_nascimento."'";
	}else{
		$data_nascimento = "NULL";
	}

	$query = "insert into usuario(login, senha, nome, data_nascimento, email, telefone, cor, imagem, id_linha_produto, id_empresa, especialidade) values('{$login}','{$senhaMd5}','{$nome}',{$data_nascimento},'{$email}', '{$telefone}', '{$cor}', '{$imagem}', '{$id_linha_produto}', '{$id_empresa}', '{$especialidade}')";
	
	$resultado = mysqli_query($conexao, $query);
	$id_usuario = mysqli_insert_id($conexao);
	if($resultado){
		$resultado = false;
		foreach ($perfis as $key => $perfil) {
			$query = "insert into usuario_perfil(id_usuario,id_perfil) values('{$id_usuario}', '{$perfil}')";
			$resultado = mysqli_query($conexao, $query);
		}
		if($resultado){
			return $resultado;
		}else{
			$query = "delete from usuario where id_usuario = '{$id_usuario}'";
			$resultado = mysqli_query($conexao, $query);
			return false;
		}
	}
	return false;
}

function inserePerfil($conexao, $nome, $descricao, $rotinas){
	$nome = utf8_decode($nome);
	$descricao = utf8_decode($descricao);
	$query = "insert into perfil(nome, descricao) values('{$nome}','{$descricao}')";
	$resultado = mysqli_query($conexao, $query);
	$id_perfil = mysqli_insert_id($conexao);
	if($resultado){
		$resultado = false;
		foreach ($rotinas as $key => $rotina) {
			// var_dump($rotina);
			if($rotina['edicao'] || $rotina['visualizacao']){
				$edicao = ($rotina['edicao'] == 1) ? $rotina['edicao'] : 0;
				$visualizacao = ($rotina['visualizacao'] == 1) ? $rotina['visualizacao'] : 0;
				$query = "insert into perfil_rotina(id_perfil,id_rotina,edicao,visualizacao) values('{$id_perfil}','{$rotina['id_rotina']}',{$edicao},{$visualizacao})";
				$resultado = mysqli_query($conexao, $query);
			}
		}
		if($resultado){
			return $resultado;
		}else{
			$query = "delete from perfil where id_perfil = '{$id_perfil}'";
			$resultado = mysqli_query($conexao, $query);
			return false;
		}
	}
	return false;
}

function insereFrase($conexao, $descricao){
	$descricao = utf8_decode($descricao);
	$query = "insert into frase(descricao) values('{$descricao}')";
	$resultado = mysqli_query($conexao, $query);
	// $id_perfil = mysqli_insert_id($conexao);
	return $resultado;
}

function verificaAdmin($permissoes){
	$isAdmin = 0;
	foreach ($permissoes as $key => $value) {
		if($value == 1){
			$isAdmin = 1;
		}
	}
	return $isAdmin;
}

/*******************/
/***** UPDATES *****/
// function alteraUsuario($conexao, $id_usuario, $senha, $nome, $data_nascimento, $email, $telefone, $perfis, $cor, $imagem, $login, $id_linha_produto, $id_empresa, $especialidade){
// 	$nome = utf8_decode($nome);
// 	$login = utf8_decode($nome);
// 	$especialidade = utf8_decode($especialidade);
// 	if($data_nascimento != ""){
// 	$data_nascimento = str_replace('/', '-', $data_nascimento);
// 	$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
// 			$data_nascimento = "'".$data_nascimento."'";
// 	}else{
// 		$data_nascimento = "NULL";
// 	}

// 	if($senha != ""){
// 	$senhaMd5 = md5($senha);
// 		$query="update usuario set senha = '{$senhaMd5}', nome = '{$nome}', data_nascimento = {$data_nascimento}, email = '{$email}', telefone = '{$telefone}', cor = '{$cor}', imagem = '{$imagem}', id_linha_produto = '{$id_linha_produto}', id_empresa = '{$id_empresa}', especialidade = '{$especialidade}'  WHERE id_usuario = '{$id_usuario}'";
// 		if($_SESSION["login"]==$login){
// 			$_SESSION["imagem"] = $imagem;
// 		}
// 	}else{
// 		$query="update usuario set nome = '{$nome}', data_nascimento = {$data_nascimento}, email = '{$email}', telefone = '{$telefone}', cor = '{$cor}', imagem = '{$imagem}',  id_linha_produto = '{$id_linha_produto}', id_empresa = '{$id_empresa}', especialidade = '{$especialidade}' WHERE id_usuario = '{$id_usuario}'";
// 		if($_SESSION["login"]==$login){
// 			$_SESSION["imagem"] = $imagem;
// 		}
// 	}
// 	$resultado = mysqli_query($conexao, $query);
// 	if($resultado){
// 		$query = "delete from usuario_perfil where id_usuario = {$id_usuario}";
// 		$resultado = mysqli_query($conexao, $query);
// 		if($resultado){
// 			$resultado = false;
// 			foreach ($perfis as $key => $perfil) {
// 				$query = "insert into usuario_perfil(id_usuario,id_perfil) values('{$id_usuario}', '{$perfil}')";
// 				$resultado = mysqli_query($conexao, $query);
// 			}
// 			if($resultado){
// 				return $resultado;
// 			}else{
// 				return false;
// 			}
// 		}
// 	}
// 	return false;
// }
function alteraUsuario($conexao, $id_usuario, $senha, $nome, $data_nascimento, $email, $telefone, $perfis, $cor, $imagem, $login, $id_linha_produto, $id_empresa, $especialidade, $status){
	$nome = utf8_decode($nome);
	$login = utf8_decode($nome);
	$especialidade = utf8_decode($especialidade);
	if($data_nascimento != ""){
	$data_nascimento = str_replace('/', '-', $data_nascimento);
	$data_nascimento = date('Y/m/d', strtotime($data_nascimento));
			$data_nascimento = "'".$data_nascimento."'";
	}else{
		$data_nascimento = "NULL";
	}

	if($senha != ""){
	$senhaMd5 = md5($senha);
		$query="update usuario set senha = '{$senhaMd5}', nome = '{$nome}', data_nascimento = {$data_nascimento}, email = '{$email}', telefone = '{$telefone}', cor = '{$cor}', imagem = '{$imagem}', id_linha_produto = '{$id_linha_produto}', id_empresa = '{$id_empresa}', especialidade = '{$especialidade}', status = '{$status}'  WHERE id_usuario = '{$id_usuario}'";
		if($_SESSION["login"]==$login){
			$_SESSION["imagem"] = $imagem;
		}
	}else{
		$query="update usuario set nome = '{$nome}', data_nascimento = {$data_nascimento}, email = '{$email}', telefone = '{$telefone}', cor = '{$cor}', imagem = '{$imagem}',  id_linha_produto = '{$id_linha_produto}', id_empresa = '{$id_empresa}', especialidade = '{$especialidade}', status = '{$status}' WHERE id_usuario = '{$id_usuario}'";
		if($_SESSION["login"]==$login){
			$_SESSION["imagem"] = $imagem;
		}
	}
	$resultado = mysqli_query($conexao, $query);
	if($resultado){
		$query = "delete from usuario_perfil where id_usuario = {$id_usuario}";
		$resultado = mysqli_query($conexao, $query);
		if($resultado){
			$resultado = false;
			foreach ($perfis as $key => $perfil) {
				$query = "insert into usuario_perfil(id_usuario,id_perfil) values('{$id_usuario}', '{$perfil}')";
				$resultado = mysqli_query($conexao, $query);
			}
			if($resultado){
				return $resultado;
			}else{
				return false;
			}
		}
	}
	return false;
}

function alteraPerfil($conexao, $id_perfil, $nome, $descricao, $rotinas){
	$nome = utf8_decode($nome);
	$descricao = utf8_decode($descricao);
	$query="update perfil set nome = '{$nome}', descricao = '{$descricao}' WHERE id_perfil = '{$id_perfil}'";
	$resultado = mysqli_query($conexao, $query);
	if($resultado){
		$query = "delete from perfil_rotina where id_perfil = {$id_perfil}";
		$resultado = mysqli_query($conexao, $query);
		if($resultado){
			$resultado = false;
			foreach ($rotinas as $key => $rotina) {
				if($rotina['edicao'] || $rotina['visualizacao']){
					$edicao = ($rotina['edicao'] == 1) ? $rotina['edicao'] : 0;
					$visualizacao = ($rotina['visualizacao'] == 1) ? $rotina['visualizacao'] : 0;
					$query = "insert into perfil_rotina(id_perfil,id_rotina,edicao,visualizacao) values('{$id_perfil}','{$rotina['id_rotina']}',{$edicao},{$visualizacao})";
					$resultado = mysqli_query($conexao, $query);
				}
				// $query = "insert into perfil_rotina(id_perfil,id_rotina) values('{$id_perfil}', '{$rotina}')";
				// $resultado = mysqli_query($conexao, $query);
			}
			if($resultado){
				return $resultado;
			}else{
				return false;
			}
		}
	}
	return false;
}

function alteraFrase($conexao, $id_frase, $descricao){
	$descricao = utf8_decode($descricao);
	$query="update frase set descricao = '{$descricao}' WHERE id_frase = '{$id_frase}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

// EDIÇÃO DO PERFIL PESSOAL
function editaPerfil($conexao, $id_usuario, $nome, $email, $telefone){
	$nome = utf8_decode($nome);
	$query="update usuario set nome = '{$nome}', email = '{$email}', telefone = '{$telefone}'  WHERE id_usuario = '{$id_usuario}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function alterarSenha($conexao, $login, $senha){
	$primeiroacesso = 0;
	$query="update usuario set senha = '{$senha}' WHERE login = '{$login}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

/*******************/
/***** DELETES *****/

function removeUsuario($conexao, $id_usuario){
	$queryUsuarioPerfil = "delete from usuario_perfil where id_usuario = '{$id_usuario}'";
	$resultadoUsuarioPerfil = mysqli_query($conexao, $queryUsuarioPerfil);
	$queryUsuario = "delete from usuario where id_usuario = '{$id_usuario}'";
	$resultadoUsuario = mysqli_query($conexao, $queryUsuario);
	return $resultadoUsuario;
}

function removePerfil($conexao, $id_perfil){
	$query = "delete from perfil_rotina where id_perfil = '{$id_perfil}'";
	$resultado = mysqli_query($conexao, $query);
	$queryPerfil = "delete from perfil where id_perfil = '{$id_perfil}'";
	$resultadoPerfil = mysqli_query($conexao, $queryPerfil);
	return $resultadoPerfil;
}

function removeFrase($conexao, $id_frase){
	$query = "delete from frase where id_frase = '{$id_frase}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}