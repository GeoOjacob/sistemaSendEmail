<?php 
	session_start();
	require_once "../../classes/conexao.php";
	require_once "../../classes/envios.php";
	$c= new conectar();
	
	$obj= new envios();

	if(count($_SESSION['tabelaComprasTemp'])==0){
		echo 0;
	}else{
		$result=$obj->criarEnvio();
		unset($_SESSION['tabelaComprasTemp']);
		echo $result;
	}
 ?>