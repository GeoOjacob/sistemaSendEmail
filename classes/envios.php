<?php 

class envios{
	public function obterDadosProduto($idproduto){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT cam.nome,
		fil.nome_filtro,
		pro.descricao,
		img.url
		from produtos as pro 
		inner join imagens as img
		on pro.id_imagem=img.id_imagem 
		inner join campanhas as cam 
		on pro.id_campanha = cam.id_campanha
		inner join filtros as fil
		on pro.id_filtro = fil.id_filtro
		where pro.id_produto='$idproduto'";
		$result=mysqli_query($conexao,$sql);

		$ver=mysqli_fetch_row($result);



		$d=explode('/', $ver[3]);

		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$dados=array(
			'nome' => $ver[0],
			'filtro' => $ver[1],
			'descricao' => $ver[2],
			'url' => $img
		);		
		return $dados;
	}

	public function criarEnvio(){
		$c= new conectar();
		$conexao=$c->conexao();

		$data=date('Y-m-d');
		$idenvio=self::criarComprovante();
		$dados=$_SESSION['tabelaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($dados) ; $i++) { 
			$d=explode("||", $dados[$i]);

			$sql="INSERT into vendas (id_envio,
										id_campanha,
										id_usuario,
										id_filtro,
										dataCompra,
										id_produto)
							values ('$idenvio',
									'$d[0]',
									'$idusuario',
									'$d[1]',
									'$data',
									'$idproduto')";

			
			$r=$r + $result=mysqli_query($conexao,$sql);



		}

		return $r;
	}

	public function criarComprovante(){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT id_venda from vendas group by id_venda desc";

		$resul=mysqli_query($conexao,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nomeCliente($idCliente){
		$c= new conectar();
		$conexao=$c->conexao();


		 $sql="SELECT sobrenome,nome 
			from clientes 
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexao,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[1]." ".$ver[0];
	}

	public function obterTotal($idvenda){
		$c= new conectar();
		$conexao=$c->conexao();


		$sql="SELECT total_venda 
				from vendas 
				where id_venda='$idvenda'";
		$result=mysqli_query($conexao,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>