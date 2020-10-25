<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/campanhas.php";



$data = date("Y-m-d");
$idusuario = $_SESSION['iduser'];
$campanha = $_POST['campanha'];


$obj = new campanhas();



$dados=array(
	$idusuario,
	$campanha,
	$data

);

echo $obj->adicionarCampanha($dados);

 ?>