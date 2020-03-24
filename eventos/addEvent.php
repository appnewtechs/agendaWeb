<?php
require_once "../bootstrap.php";
$pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
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
if (isset($_POST['titleEdit']) && (isset($_POST['datas_trabalho_periodo']) || isset($_POST['datas_trabalho'])) && isset($_POST['id_usuario'])){
	
	$title = utf8_decode($_POST['titleEdit']);
	$id_usuario = $_POST['id_usuario'];
	$id_creator = $_POST['id_creator'];
	$fechado = $_POST['fechado'];
	$status = ($_POST['status']);
	$empresa = ($_POST['id_empresa']);
	$cliente = $_POST['cliente'];
	$tipo_data = $_POST['tipo_data'];
	if($cliente == ''){
		$cliente = 0;
	}
	$tipo_trabalho = utf8_decode($_POST['tipo_trabalho']);
	$id_evento = 0;
	if($tipo_data==2){
		$datas_trabalho2 = $_POST['datas_trabalho_periodo'];
		$datas_trabalho = explode(",", $_POST['datas_trabalho_periodo']);
		$datas_trabalho = str_replace('/', '-', $datas_trabalho);

		$begin = new DateTime($datas_trabalho[0]);
		$end = new DateTime($datas_trabalho[1]);

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		$x=0;
		for($i = $begin; $i <= $end; $i->modify('+1 day')){
			$value = date('Y-m-d H:i:s', strtotime($i->format("Y-m-d")));
			if($x == 0){
				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, cliente, tipo_trabalho, id_creator, tipo_data) values ('0','$title', '$value', '$value', '', '$id_usuario', '$fechado', '$status', '$empresa', '$cliente', '$tipo_trabalho', '$id_creator', '$tipo_data')";
				// echo $sql;
				$resultado1 = mysqli_query($conexao, $sql);
				$sqlId = "select id from events ORDER BY id DESC";
				$resultadoId = mysqli_query($conexao, $sqlId);
				$result_id_evento = mysqli_fetch_assoc($resultadoId);
				$id_evento = $result_id_evento["id"];
				$sqlUpdate = "UPDATE events set id_evento = '{$id_evento}' where id = '{$id_evento}'";
				$resultado2 = mysqli_query($conexao, $sqlUpdate);
			}else{
				$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, cliente, tipo_trabalho, id_creator, tipo_data) values ('$id_evento', '$title', '$value', '$value', '', '$id_usuario', '$fechado', '$status', '$empresa', '$cliente', '$tipo_trabalho', '$id_creator', '$tipo_data')";
				$resultado3 = mysqli_query($conexao, $sql);
			}
			$x++;
		}
		exit();
	}

	$datas_trabalho = explode(",", $_POST['datas_trabalho']);
	$datas_trabalho = str_replace('/', '-', $datas_trabalho);

	//  foreach ($datas_trabalho as $key => $value) {
	// 	$value = date('Y-m-d H:i:s', strtotime($value));
	// 	$resultado_fechado = mysqli_query($conexao, "SELECT start,fechado FROM events WHERE start='$value' AND fechado='1' AND id_usuario='$id_usuario'");
	// 		$numero_fechado = mysqli_num_rows($resultado_fechado);
	// 		if($numero_fechado > 0) {
	// 			$_SESSION["danger"] = 'Este dia do usuário foi bloqueado.';
 	// 			header('Location: agenda.php'.$filtro);
 	// 			die();
	// 		}
	// }

	
	foreach ($datas_trabalho as $key => $value) {
		$value = date('Y-m-d H:i:s', strtotime($value));
		if($key == 0){
			$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, cliente, tipo_trabalho, id_creator, tipo_data) values ('0','$title', '$value', '$value', '', '$id_usuario', '$fechado', '$status', '$empresa', '$cliente', '$tipo_trabalho', '$id_creator', '$tipo_data')";
			// echo $sql;
			$resultado1 = mysqli_query($conexao, $sql);
			$sqlId = "select id from events ORDER BY id DESC";
			$resultadoId = mysqli_query($conexao, $sqlId);
			$result_id_evento = mysqli_fetch_assoc($resultadoId);
			$id_evento = $result_id_evento["id"];
			$sqlUpdate = "UPDATE events set id_evento = '{$id_evento}' where id = '{$id_evento}'";
			$resultado2 = mysqli_query($conexao, $sqlUpdate);
		}else{
			$sql = "INSERT INTO events(id_evento, title, start, end, descricao, id_usuario, fechado, status, empresa, cliente, tipo_trabalho, id_creator, tipo_data) values ('$id_evento', '$title', '$value', '$value', '', '$id_usuario', '$fechado', '$status', '$empresa', '$cliente', '$tipo_trabalho', '$id_creator', '$tipo_data')";
			$resultado3 = mysqli_query($conexao, $sql);
		}
	}
}
	// header('Location: agenda.php'.$filtro);
?>
