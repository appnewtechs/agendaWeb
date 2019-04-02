<?php

    include('conecta.php');

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];


$query = "UPDATE eventos SET title='$title', start='$start', end='$end' WHERE id='$id'";
$resultado = mysqli_query($conexao, $query);                         
echo $resultado;    


?>