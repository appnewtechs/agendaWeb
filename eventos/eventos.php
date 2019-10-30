<?php
require_once "../bootstrap.php";
$isAdmin = verificaAdmin($_SESSION["rotina"]);
$usuarioLogado = buscaUsuario($conexao, $_SESSION["login"]);
$pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
// $sql = "select events.*, usuario.nome as nome_usuario, trabalho.cor as cor_trabalho, cliente.id_tipo_cliente as id_tipo_cliente FROM `events` INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho limit 100";
$start = $_POST['start'];
$end = $_POST['end'];
$sql = '';
if($isAdmin == 1){
    $sql = "select events.id, events.id_evento, events.start, events.end, events.id_usuario, 
        events.id_agenciado_ficha, events.empresa, events.id_linha_produto, events.status, events.fechado, events.tipo_data, events.id_creator, 
        events.cliente, events.tipo_trabalho, CONCAT(usuario.nome, ' - ',events.title) as title, events.title as titleEdit, 
        usuario.nome as nome_usuario, CONCAT('#',trabalho.cor) as color, 
        cliente.id_tipo_cliente as id_tipo_cliente FROM `events` 
        INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario 
        LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario 
        left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho where start BETWEEN '{$start}' and '{$end}'";
}else{
    $sql = "select events.id, events.id_evento, events.start, events.end, events.id_usuario, 
        events.id_agenciado_ficha, events.empresa, events.id_linha_produto, events.status, events.fechado, events.tipo_data, events.id_creator, 
        events.cliente, events.tipo_trabalho, CONCAT(usuario.nome, ' - ',events.title) as title, events.title as titleEdit, 
        usuario.nome as nome_usuario, CONCAT('#',trabalho.cor) as color, 
        cliente.id_tipo_cliente as id_tipo_cliente FROM `events` 
        INNER JOIN `usuario` ON events.id_usuario = usuario.id_usuario 
        LEFT JOIN `cliente` ON usuario.id_usuario = cliente.id_usuario 
        left join `trabalho` on events.tipo_trabalho = trabalho.id_trabalho where
        events.id_usuario = " . $usuarioLogado . " start BETWEEN '{$start}' and '{$end}'";
}
$req = $pdo->prepare($sql);
$req->execute();
$eventos = $req->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($eventos);