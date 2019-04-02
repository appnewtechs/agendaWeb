<?php


    include('conecta.php');
                          

$id = $_POST['id'];
$query = "DELETE from eventos WHERE id='$id'";    
$resultado = mysqli_query($conexao, $query);                         

?>