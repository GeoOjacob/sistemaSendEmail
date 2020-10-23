<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/gerenciamentoFiltro.php";



$obj = new gerenciamentoFiltro();



$dados=array(
	$_POST['idfiltro'],
	$_POST['filtroU'],
	$_POST['desc_filtroU']

);

echo $obj->atualizarFiltro($dados);

 ?>