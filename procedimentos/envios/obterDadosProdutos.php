<?php 
	
	require_once "../../classes/conexao.php";
	require_once "../../classes/envios.php";

	$obj= new envios();

	echo json_encode($obj->obterDadosProduto($_POST['idproduto']));

 ?>