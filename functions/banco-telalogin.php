<?php
function selecionaImagemFundo($conexao)
{
	$array = array();
	$query = "select telafundo from config";
	$resultado = mysqli_query($conexao, $query);
	while ($telafundo = mysqli_fetch_assoc($resultado)) {
		array_push($array, $telafundo);
	}
	return $array;
}
function selecionaImagemFundoId($conexao, $id)
{
	$array = array();

	$query = "SELECT telafundo FROM telas WHERE id='$id'";
	$resultado = mysqli_query($conexao, $query);
	while ($telafundo = mysqli_fetch_assoc($resultado)) {
		array_push($array, $telafundo);
	}
	return $array;
}
 