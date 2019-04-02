<?php
	require(dirname(__FILE__).'/../eventos/bdd.php');
	require(dirname(__FILE__).'/../funcoes.php');
	// $sql = "select events.*, usuario.nome as nome_usuario, usuario.cor as cor_usuario, cliente.id_tipo_cliente as id_tipo_cliente FROM `events` INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario";
	$usuarioLogado = buscaUsuario($conexao,$_SESSION["login"]);
	$isAdmin = verificaAdmin($_SESSION["rotina"]);
	$sql = '';
	// if($isAdmin == 1){
	// 	$sql = "select events.*, usuario.nome as nome_usuario, usuario.cor as cor_usuario, trabalho.cor as cor_trabalho, cliente.id_tipo_cliente as id_tipo_cliente FROM `events` INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho";
	// }else{
		$sql = 'select events.*, usuario.nome as nome_usuario, usuario.cor as cor_usuario, trabalho.cor as cor_trabalho, cliente.id_tipo_cliente as id_tipo_cliente FROM `events` INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho WHERE events.id_usuario = '.$usuarioLogado["id_usuario"];
	// }
	$req = $bdd->prepare($sql);
	$req->execute();
	$events = $req->fetchAll();

	?>
<!-- Custom CSS -->
<style>
	#calendar {
	max-width: 1000px;
	max-height: 400px;
	}
	.col-centered{
	float: none;
	margin: 0 auto;
	}
</style>

<div class="row">
	<div class="col-xs-12">
		<div id="calendario"></div>
	</div>

</div>

<script>
var selectedEvents = [
	<?php foreach($events as $event):
	$start = explode(" ", $event['start']);
	$end = explode(" ", $event['end']);
	$empresa = chamacampo('empresa','nome_fantasia',"WHERE id_empresa='".$event['empresa']."'",$conexao);
	$titulo = $empresa.' - '.$event['title']; 
	if($start[1] == '00:00:00'){
	$start = $start[0];
	}else{
			$start = $event['start'];
		}
		if($end[1] == '00:00:00'){
	$end = $end[0];
	}else{
	$end = $event['end'];
	}
	?>
	{
		id: '<?php echo $event['id']; ?>',
		title: '<?php echo $titulo; ?>',
		start: '<?php echo $start; ?>',
		end: '<?php echo $end; ?>',
		color: '<?php echo $event['cor_trabalho']; ?>',
		id_usuario: '<?php echo $event['id_usuario']; ?>',
		descricao: '<?php echo $event['descricao']; ?>',
		nome_usuario: '<?php echo $event['nome_usuario']; ?>',
		id_tipo_cliente: '<?php echo $event['id_tipo_cliente']; ?>'
	},
	<?php endforeach; ?>
];


$(document).ready(function() {
	$('#calendario').fullCalendar({
		header:false,
		displayEventTime: true,
		defaultView: 'basicWeek',
		height: 150,
		firstDay: new Date().getDay() - 1,
		events: selectedEvents
	});
});
</script>