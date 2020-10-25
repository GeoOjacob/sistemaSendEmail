<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/campanhas.php";



$obj = new campanhas();



$dados=array(
	$_POST['idcampanha'],
	$_POST['campanhaU']

);

echo $obj->atualizarCampanha($dados);

 ?>