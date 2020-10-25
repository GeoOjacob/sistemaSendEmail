<?php 

class campanhas{
	public function adicionarCampanha($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "INSERT into campanhas (id_usuario, nome, dataCriacao) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]')";

		return mysqli_query($conexao, $sql);
	}


	public function atualizarCampanha($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE campanhas SET nome = '$dados[1]' where id_campanha = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluirCampanha($idcampanha){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from campanhas where id_campanha = '$idcampanha' ";

		return mysqli_query($conexao, $sql);
	}

}

?>