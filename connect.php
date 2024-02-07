<?php 


$hostname = "localhost";
$bancodedados = "pokemonsdias";
$usuario = "root";
$senha = "";
date_default_timezone_set('America/Sao_Paulo');

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    echo "Falha ao conectar : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}