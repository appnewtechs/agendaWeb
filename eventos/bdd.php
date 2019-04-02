<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=newtech;charset=utf8', 'root', 'newtech');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
