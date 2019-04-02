<?php

// Connexion à la base de données
require_once('bdd.php');
require_once("../logica-usuario.php"); 
include("../banco-usuario.php");  
include("../funcoes.php"); 
include("../banco-financeiro.php");
//echo $_POST['title'];
// session_start();
$add_selected_usuario = @$_POST['add_selected_usuario'];
$add_selected_empresa = @$_POST['add_selected_empresa'];
$add_selected_trabalho = @$_POST['add_selected_trabalho'];
$add_selected_cliente = @$_POST['add_selected_cliente'];
$filtro = '?';
$var = 0;

if($add_selected_usuario != ''){
	$filtro .= 'selected_usuario='.$add_selected_usuario;
	$var = 1;
}
if($add_selected_empresa != ''){
	if($var==1){
		$filtro .= '&selected_empresa='.$add_selected_empresa;
	}else{
		$filtro .= 'selected_empresa='.$add_selected_empresa;
		$var = 1;
	}
}
if($add_selected_cliente != ''){
	if($var==1){
		$filtro .= '&selected_cliente='.$add_selected_cliente;
	}else{
		$filtro .= 'selected_cliente='.$add_selected_cliente;
		$var = 1;
	}
}
if($add_selected_trabalho != ''){
	if($var==1){
		$filtro .= '&selected_trabalho='.$add_selected_trabalho;
	}else{
		$filtro .= 'selected_trabalho='.$add_selected_trabalho;
	}
}
if (isset($_POST['title']) && isset($_POST['datas_trabalho']) && isset($_POST['id_usuario'])){
	
	$title = utf8_decode($_POST['title']);
	// $start = date('Y-m-d H:i:s', strtotime($_POST['start']));
	// $end = date('Y-m-d H:i:s', strtotime($_POST['end']));
	$descricao = utf8_decode(enter($_POST['descricao']));
	$id_usuario = $_POST['id_usuario'];
	$fechado = $_POST['fechado'];
	$status = utf8_decode($_POST['status']);
	$linha_produto = utf8_decode($_POST['linha_produto']);
	$empresa = utf8_decode($_POST['empresa']);
	$cliente = utf8_decode($_POST['cliente']);
	$tipo_trabalho = utf8_decode($_POST['tipo_trabalho']);

	$datas_trabalho = explode(",", $_POST['datas_trabalho']);
	$datas_trabalho = str_replace('/', '-', $datas_trabalho);

	foreach ($datas_trabalho as $key => $value) {
		$value = date('Y-m-d H:i:s', strtotime($value));
		$resultado_fechado = mysqli_query($conexao, "SELECT start,fechado FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
			$numero_fechado = mysqli_num_rows($resultado_fechado);
			if($numero_fechado > 0) {
				$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
 				header('Location: agenda.php'.$filtro);
 				die();
			}
	}

	$id_evento = 0;
	foreach ($datas_trabalho as $key => $value) {
		$value = date('Y-m-d H:i:s', strtotime($value));
		if($key == 0){

			// $resultado_fechado = mysqli_query($conexao, "SELECT start,fechado FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
			// $numero_fechado = mysqli_num_rows($resultado_fechado);

			// if($numero_fechado > 0) {


			// 	$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
				

			// }
			// else
			// {
				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, id_linha_produto, cliente, tipo_trabalho) values ('0','$title', '$value', '$value', '$descricao', '$id_usuario', '$fechado', '$status', '$empresa', '$linha_produto', '$cliente', '$tipo_trabalho')";
				$resultado1 = mysqli_query($conexao, $sql);
				$sqlId = "select id from events ORDER BY id DESC";
				$resultadoId = mysqli_query($conexao, $sqlId);
				$result_id_evento = mysqli_fetch_assoc($resultadoId);
				$id_evento = $result_id_evento["id"];
				$sqlUpdate = "UPDATE events set id_evento = '{$id_evento}' where id = '{$id_evento}'";
				$resultado2 = mysqli_query($conexao, $sqlUpdate);
			// }

			
		}else{

			// $resultado_fechado = mysqli_query($conexao, "SELECT start,fechado FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
			// $numero_fechado = mysqli_num_rows($resultado_fechado);

			// if($numero_fechado > 0) {


			// 	$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
				
			// }
			// else
			// {
						$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, id_linha_produto, cliente, tipo_trabalho) values ('$id_evento', '$title', '$value', '$value', '$descricao', '$id_usuario', '$fechado', '$status', '$empresa', '$linha_produto', '$cliente', '$tipo_trabalho')";
			$resultado3 = mysqli_query($conexao, $sql);
		// }
			}

	
	}
}
// header('Location: '.$_SERVER['HTTP_REFERER']);
	header('Location: agenda.php'.$filtro);
?>
