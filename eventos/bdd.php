<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=newtech;charset=utf8', 'root', 'BB320011005b$');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
