

<?php 
	class produtos{
		public function addImagem($dados){
			$c= new conectar();
			$conexao=$c->conexao();

			$data=date('Y-m-d');

			$sql="INSERT into imagens (id_campanha,
										nome,
										url,
										dataUpload)
							values ('$dados[0]',
									'$dados[1]',
									'$dados[2]',
									'$data')";
			$result=mysqli_query($conexao,$sql);

			return mysqli_insert_id($conexao);
		}
		public function inserirProduto($dados){
			$c= new conectar();
			$conexao=$c->conexao();

			$data=date('Y-m-d');

			$sql="INSERT into produtos (id_campanha,
										id_filtro,
										descricao,
										dataCaptura,
										id_imagem,
										id_usuario) 
							values ('$dados[0]',
									'$dados[1]',
									'$dados[2]',
									'$data',
									'$dados[3]',
									'$dados[4]')";
			return mysqli_query($conexao,$sql);
		}



		public function obterDados($idproduto){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT id_produto, 
						id_campanha, 
						id_filtro,
						descricao,
						id_imagem,
						id_usuario
				from produtos 
				where id_produto='$idproduto'";
			$result=mysqli_query($conexao,$sql);

			$mostrar=mysqli_fetch_row($result);

			$dados=array(
					"id_produto" => $mostrar[0],
					"id_campanha" => $mostrar[1],
					"id_filtro" => $mostrar[2],
					"descricao" => $mostrar[3],
					"id_imagem" => $mostrar[4],
					"id_usuario" => $mostrar[5]
						);

			return $dados;
		}



		public function atualizar($dados){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="UPDATE produtos set id_campanha='$dados[1]', 
										id_filtro='$dados[2]',
										descricao='$dados[3]'
						where id_produto='$dados[0]'";

			return mysqli_query($conexao,$sql);
		}



		public function excluir($idproduto){
			$c= new conectar();
			$conexao=$c->conexao();

			$idimagem=self::obterIdImg($idproduto);

			$sql="DELETE from produtos 
					where id_produto='$idproduto'";
			$result=mysqli_query($conexao,$sql);

			if($result){
				$url=self::obterUrlImagem($idimagem);

				$sql="DELETE from imagens 
						where id_imagem='$idimagem'";
				$result=mysqli_query($conexao,$sql);
					if($result){
						if(unlink($url)){
							return 1;
						}
					}
			}
		}

		public function obterIdImg($idProduto){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT id_imagem 
					from produtos 
					where id_produto='$idProduto'";
			$result=mysqli_query($conexao,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obterUrlImagem($idImg){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT url 
					from imagens 
					where id_imagem='$idImg'";

			$result=mysqli_query($conexao,$sql);

			return mysqli_fetch_row($result)[0];
		}

		
	}

 ?>