<?php  
require_once "../bootstrap.php";

function data_eua_brasil2($data)
{
	$array = explode("-",$data);
	
	return $array[2].'/'.$array[1].'/'.$array[0];
}

$id_evento = $_POST["id_evento"];
$eventos = "";
$query = "select * from events where id_evento = '{$id_evento}'";
$resultado = mysqli_query($conexao, $query);
while ($evento = mysqli_fetch_assoc($resultado)) {
	$data = date('Y-m-d', strtotime($evento['start']));
	$eventos .= data_eua_brasil2($data).',';   
}  
$eventos = substr_replace($eventos, '', -1);;
echo $eventos;
?>
