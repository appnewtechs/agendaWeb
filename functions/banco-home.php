<?php

function buscaAniversariantesDaSemana($conexao){
	$aniversariantes =  array();
	$query = "SELECT nome,
						DATE_FORMAT(data_nascimento, '%d/%m') AS data_nascimento,
						'Contato' AS tipo
						FROM contato
						WHERE DATE_FORMAT(data_nascimento, '%m-%d')
						BETWEEN DATE_FORMAT(NOW(), '%m-%d')
						AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 MONTH), '%m-%d')";

	$resultado = mysqli_query($conexao, $query);
	while ($aniversariante = mysqli_fetch_assoc($resultado)) {
		array_push($aniversariantes, $aniversariante);
	}

	$query = "SELECT nome,
						DATE_FORMAT(data_nascimento, '%d/%m') AS data_nascimento,
						'Usuário' AS tipo
						FROM usuario
						WHERE DATE_FORMAT(data_nascimento, '%m-%d')
						BETWEEN DATE_FORMAT(NOW(), '%m-%d')
						AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 MONTH), '%m-%d')";

	$resultado = mysqli_query($conexao, $query);
	while ($aniversariante = mysqli_fetch_assoc($resultado)) {
		array_push($aniversariantes, $aniversariante);
	}

  return $aniversariantes;
}

function buscaLembretes($conexao,$id_usuario){
	$query = "SELECT * FROM lembrete WHERE id_usuario_destinatario = '{$id_usuario}'";
	// var_dump($id_usuario);
	$resultado = mysqli_query($conexao, $query);
	$lembretes = array();
	while ($lembrete = mysqli_fetch_assoc($resultado)) {
		array_push($lembretes, $lembrete);
	}  	
  	return $lembretes;
}

function insereLembrete($conexao, $descricao, $id_usuario_destinatario, $id_usuario_remetente){
	$descricao = utf8_decode($descricao);
	$query = "insert into lembrete(descricao,id_usuario_destinatario,id_usuario_remetente) values('{$descricao}','{$id_usuario_destinatario}','{$id_usuario_remetente}')";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

function removeLembrete($conexao, $id_lembrete){
	$query = "delete from lembrete where id_lembrete = '{$id_lembrete}'";
	$resultado = mysqli_query($conexao, $query);
	return $resultado;
}

?>