<?php 

include('conecta.php');


/*******************/
/***** SELECTS *****/

function ListaTiposClientesPaginado($conexao, $page){
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


?>