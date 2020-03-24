<?php  
require_once "../bootstrap.php";

$usuario = $_POST["id_usuario"];
$empresa = "";
$query = "select * from usuario where id_usuario = '{$usuario}'";
$resultado = mysqli_query($conexao, $query);
while ($usuario = mysqli_fetch_assoc($resultado)) {
	$empresa = $usuario['id_empresa'];    
}  
echo $empresa;
?>
