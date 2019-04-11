<?php
require_once "../bootstrap.php";
$pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
// require_once('bdd.php');
// require_once("../logica-usuario.php"); 
// include("../banco-usuario.php"); 
// include("../banco-financeiro.php");
// include("../funcoes.php");
// echo $_POST['titleEdit'];
// echo $_POST['id_evento'];
// exit();
$edit_selected_usuario = @$_POST['edit_selected_usuario'];
$edit_selected_empresa = @$_POST['edit_selected_empresa'];
$edit_selected_trabalho = @$_POST['edit_selected_trabalho'];
$edit_selected_cliente = @$_POST['edit_selected_cliente'];
$filtro = '?';
$var = 0;

if($edit_selected_usuario != ''){
	$filtro .= 'selected_usuario='.$edit_selected_usuario;
	$var = 1;
}
if($edit_selected_empresa != ''){
	if($var==1){
		$filtro .= '&selected_empresa='.$edit_selected_empresa;
	}else{
		$filtro .= 'selected_empresa='.$edit_selected_empresa;
		$var = 1;
	}
}
if($edit_selected_cliente != ''){
	if($var==1){
		$filtro .= '&selected_cliente='.$edit_selected_cliente;
	}else{
		$filtro .= 'selected_cliente='.$edit_selected_cliente;
		$var = 1;
	}
}
if($edit_selected_trabalho != ''){
	if($var==1){
		$filtro .= '&selected_trabalho='.$edit_selected_trabalho;
	}else{
		$filtro .= 'selected_trabalho='.$edit_selected_trabalho;
	}
}

if (isset($_POST['delete']) && isset($_POST['id_evento'])){
	$id = $_POST['id_evento'];
	$id_evento = $_POST['id_evento'];
	$sql = "DELETE FROM events WHERE id_evento = $id_evento";
	$query = $pdo->prepare( $sql );
	if ($query == false) {
	 print_r($pdo->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
}elseif (isset($_POST['titleEdit']) && isset($_POST['id_evento'])){
	$id = $_POST['id_evento'];
	$title = utf8_decode($_POST['titleEdit']);
	$id_evento = $_POST['id_evento'];
	$id_usuario = $_POST['id_usuario'];
	$fechado = $_POST['fechado'];
	$status = utf8_decode($_POST['status']);
	$empresa = utf8_decode($_POST['empresa']);
	$cliente = $_POST['cliente'];
	if($cliente == ''){
		$cliente = 0;
	}
	$tipo_trabalho = utf8_decode($_POST['tipo_trabalho']);
	
	$datas_trabalho_str = $_POST['datas_trabalho'];
	$datas_trabalho = explode(",", $_POST['datas_trabalho']);
	$datas_trabalho = str_replace('/', '-', $datas_trabalho);

	foreach ($datas_trabalho as $key => $value) {
		$value = date('Y-m-d H:i:s', strtotime($value));
		$resultado_fechado = mysqli_query($conexao, "SELECT start,fechado,id,id_evento FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
		$numero_fechado = mysqli_num_rows($resultado_fechado);
		$editar = 0;
		if($numero_fechado > 0) {
			foreach ($resultado_fechado as $key => $numerofechado) {
				if($id_evento == $numerofechado['id_evento']){
					$editar = 1;
				}
			}
			if($editar==0){
				$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
				header('Location: agenda.php'.$filtro);
				die();
			}
		}
	}
	$sqlDelete = "DELETE FROM events WHERE id_evento = $id_evento";
	$resultadoDelete = mysqli_query($conexao, $sqlDelete);
	foreach ($datas_trabalho as $key => $value) {
		$value = date('Y-m-d H:i:s', strtotime($value));
		$title = utf8_decode($title);
		if($key == 0){
			$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, cliente, tipo_trabalho) values ('0','$title', '$value', '$value', '', '$id_usuario', '$fechado', '$status', '$empresa', '$cliente', '$tipo_trabalho')";
			echo "teste 1 ";
			var_dump($sql);
			$resultado1 = mysqli_query($conexao, $sql);
			$sqlId = "select id from events ORDER BY id DESC";
			$resultadoId = mysqli_query($conexao, $sqlId);
			$result_id_evento = mysqli_fetch_assoc($resultadoId);
			$id_evento = $result_id_evento["id"];
			$sqlUpdate = "UPDATE events set id_evento = '{$id_evento}' where id = '{$id_evento}'";
			$resultado2 = mysqli_query($conexao, $sqlUpdate);
		}else{
			echo "teste 2 ";
			$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, cliente, tipo_trabalho) values ('$id_evento', '$title', '$value', '$value', '', '$id_usuario', '$fechado', '$status', '$empresa', '$cliente', '$tipo_trabalho')";
			var_dump($sql);
			$resultado3 = mysqli_query($conexao, $sql);
		}
	}
}

//  header('Location: agenda.php'.$filtro);

	
?>
