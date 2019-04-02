<?php
	include('conecta.php');
    
	$query = "select * from eventos";
	$eventos = array();
	$resultado = mysqli_query($conexao, $query);
	while ($evento = mysqli_fetch_assoc($resultado)) {
		array_push($eventos, $evento);
	}
    echo json_encode($eventos);
    
?>
