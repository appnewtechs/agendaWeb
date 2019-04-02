<?php 

    include('conecta.php');
                          

$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

    $query = "INSERT INTO `eventos` (`title`, `start`, `end`) VALUES ('$title', '$start', '$end')";
    $resultado = mysqli_query($conexao, $query);                         
    echo $resultado;
    
       
?>