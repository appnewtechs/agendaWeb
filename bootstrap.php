<?php
 /* ENV
-------------------------------------------- */
define('DEBUG', 0);

$base_url = 'http://localhost:8080';

define('BASE_URL', $base_url);

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/* BANCO
-------------------------------------------- */
define('DB_SERVER', 'newtech-mysql');
define('DB_NAME', 'db');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$conexao = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

/* INCLUDES
-------------------------------------------- */
include "functions/banco-cadastros.php";
include "functions/banco-usuario.php";
include "functions/banco-home.php";
include "functions/funcoes.php";
include "functions/logica-usuario.php";
include "functions/banco-telalogin.php";

date_default_timezone_set('America/Sao_Paulo');