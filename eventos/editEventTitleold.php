<?php

require_once('bdd.php');
require_once("../logica-usuario.php"); 
include("../banco-usuario.php"); 
include("../banco-financeiro.php");
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	$id_evento = $_POST['id_evento'];
	$sql = "DELETE FROM events WHERE id_evento = $id_evento";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	if(isset($_POST['id_empresa_ficha'])){
	$id_empresa_ficha = $_POST['id_empresa_ficha'];
		$sqlUpdateEmpresa = "UPDATE ficha_trabalho set datas_trabalho = '' where id_ficha_trabalho = '{$id_empresa_ficha}'";
			$resultado3 = mysqli_query($conexao, $sqlUpdateEmpresa);
	$sql = "DELETE FROM events WHERE id_empresa_ficha = $id_empresa_ficha";
	}

	
}elseif (isset($_POST['title']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = utf8_decode($_POST['title']);
	$descricao = utf8_decode($_POST['descricao']);
	$id_evento = $_POST['id_evento'];
	$id_usuario = $_POST['id_usuario'];
	$fechado = $_POST['fechado'];
	
	$datas_trabalho_str = $_POST['datas_trabalho'];
	$datas_trabalho = explode(",", $_POST['datas_trabalho']);
	$datas_trabalho = str_replace('/', '-', $datas_trabalho);
	$id_empresa_ficha = $_POST['id_empresa_ficha'];

	
	
	foreach ($datas_trabalho as $key => $value) {
		$value = date('Y-m-d H:i:s', strtotime($value));
		if($key == 0){

			$resultado_fechado = mysqli_query($conexao, "SELECT start,fechado FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
			$numero_fechado = mysqli_num_rows($resultado_fechado);

			if($numero_fechado > 0) {


				$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
				

			}
			else
			{
				$sqlDelete = "DELETE FROM events WHERE id_evento = $id_evento";
	$resultadoDelete = mysqli_query($conexao, $sqlDelete);

	$id_evento = 0;
			if($id_empresa_ficha==""){
				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado) values ('0','$title', '$value', '$value', '$descricao', '$id_usuario', '$fechado')";
				$resultado1 = mysqli_query($conexao, $sql);
			}else{
				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, id_empresa_ficha, fechado) values ('0','$title', '$value', '$value', '$descricao', '$id_usuario', '$id_empresa_ficha', '$fechado')";
				$resultado1 = mysqli_query($conexao, $sql);
			}
			// $resultado1 = mysqli_query($conexao, $sql);
			$sqlId = "select id from events ORDER BY id DESC";
			$resultadoId = mysqli_query($conexao, $sqlId);
			$result_id_evento = mysqli_fetch_assoc($resultadoId);
			$id_evento = $result_id_evento["id"];
			$sqlUpdate = "UPDATE events set id_evento = '{$id_evento}' where id = '{$id_evento}'";
			$resultado2 = mysqli_query($conexao, $sqlUpdate);

		}
		}else{

			$resultado_fechado = mysqli_query($conexao, "SELECT start,fechado FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
			$numero_fechado = mysqli_num_rows($resultado_fechado);

			if($numero_fechado > 0) {


				$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
				

			}
			else
			{
				$sqlDelete = "DELETE FROM events WHERE id_evento = $id_evento";
	$resultadoDelete = mysqli_query($conexao, $sqlDelete);
	$id_evento = 0;
				if($id_empresa_ficha==""){

				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado) values ('$id_evento', '$title', '$value', '$value', '$descricao', '$id_usuario', '$fechado')";
				$resultado3 = mysqli_query($conexao, $sql);
				}else{
				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, id_empresa_ficha, fechado) values ('$id_evento', '$title', '$value', '$value', '$descricao', '$id_usuario', '$id_empresa_ficha', '$fechado')";
				$resultado3 = mysqli_query($conexao, $sql);
				}
			}
		}
	}
	// var_dump($_POST['id_empresa_ficha']);
	// var_dump(isset($_POST['id_empresa_ficha']));
	if(isset($id_empresa_ficha)){

		$sqlUpdateEmpresa = "UPDATE empresa_ficha set datas_trabalho = '$datas_trabalho_str' where id_empresa_ficha = '{$id_empresa_ficha}'";
			$resultado3 = mysqli_query($conexao, $sqlUpdateEmpresa);
	}
// 	$sql = "UPDATE events SET  title = '$title', descricao = '$descricao', start = '$start', end = '$end' WHERE id = $id ";
// var_dump($sql);
	
// 	$query = $bdd->prepare( $sql );
// 	if ($query == false) {
// 	 print_r($bdd->errorInfo());
// 	 die ('Erreur prepare');
// 	}
// 	$sth = $query->execute();
// 	if ($sth == false) {
// 	 print_r($query->errorInfo());
// 	 die ('Erreur execute');
// 	}

}
 header('Location: agenda.php');

	
?>
