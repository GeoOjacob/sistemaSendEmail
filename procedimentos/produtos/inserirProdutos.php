<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../classes/conexao.php";
	require_once "../../classes/produtos.php";

	$obj= new produtos();

	$dados=array();
	
	$nomeImg=$_FILES['imagem']['name'];
	$urlArmazenamento=$_FILES['imagem']['tmp_name'];
	$pasta='../../arquivos/';
	$urlFinal=$pasta.$nomeImg;

	$dadosImg=array(
		$_POST['campanhaSelect'],
		$nomeImg,
		$urlFinal
					);

		if(move_uploaded_file($urlArmazenamento, $urlFinal)){
				$idimagem=$obj->addImagem($dadosImg);

				if($idimagem > 0){

					$dados[0]=$_POST['campanhaSelect'];
					$dados[1]=$_POST['filtroSelect'];
					$dados[2]=$_POST['descricao'];
					$dados[3]=$idimagem;
					$dados[4]=$iduser;

					echo $obj->inserirProduto($dados);
				}else{
					echo 0;
				}
		}

 ?>