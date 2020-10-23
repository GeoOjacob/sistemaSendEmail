<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/gerenciamentoFiltro.php";



$data = date("Y-m-d");
$idusuario = $_SESSION['iduser'];
$filtro = $_POST['filtro'];


$obj = new gerenciamentoFiltro();



$dados=array(
	$idusuario,
	$_POST['filtro'],
	$_POST['desc_filtro']

);

echo $obj->adicionarFiltro($dados);

 ?>