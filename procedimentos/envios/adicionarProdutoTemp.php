<?php 
	session_start();
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$idfiltro=$_POST['clienteEnvio'];
	$idproduto=$_POST['produtoEnvio'];
	$descricao=$_POST['descricaoV'];

	$sql="SELECT nome_filtro
			from filtros 
			where id_filtro='$idfiltro'";
	$result=mysqli_query($conexao,$sql);

	$nomefiltro=mysqli_fetch_row($result)[0];



	$sql="SELECT cam.nome, fil.nome_filtro, pro.descricao 
			from produtos as pro
			inner join campanhas as cam 
			on pro.id_campanha = cam.id_campanha
			inner join filtros as fil
			on pro.id_filtro = fil.id_filtro
			where pro.id_produto='$idproduto'";
	$result=mysqli_query($conexao,$sql);


	$nomeproduto=mysqli_fetch_row($result)[0];

	$produto=$idproduto."||".
				$nomeproduto."||".
				$nomefiltro."||".
				$descricao;

	$_SESSION['tabelaComprasTemp'][]=$produto;