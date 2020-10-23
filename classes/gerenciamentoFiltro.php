<?php 

class gerenciamentoFiltro{
	public function adicionarFiltro($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "INSERT into filtros (id_usuario, nome_filtro, desc_filtro) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]')";

		return mysqli_query($conexao, $sql);
	}


	public function atualizarFiltro($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE filtros SET nome_filtro = '$dados[1]', desc_filtro = '$dados[2]' where id_filtro = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluirFiltro($idfiltro){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from filtros where id_filtro = '$idfiltro' ";

		return mysqli_query($conexao, $sql);
	}

}

?>