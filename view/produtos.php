<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>produtos</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../classes/conexao.php"; 
		$c= new conectar();
		$conexao=$c->conexao();
		$sql="SELECT id_campanha,nome
		from campanhas";
		$result=mysqli_query($conexao,$sql);

		$sql="SELECT id_filtro,nome_filtro
		from filtros";
		$result2=mysqli_query($conexao,$sql);
		?>
	</head>
	<body>
		<div class="container">
		<h1>Configurar Campanha</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmProdutos" enctype="multipart/form-data">
						<label>Campanha</label>
						<select class="form-control input-sm" id="campanhaSelect" name="campanhaSelect">
							<option value="A">Selecionar Campanha</option>
							<?php while($mostrar=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>

						<label>Filtro</label>
						<select class="form-control input-sm" id="filtroSelect" name="filtroSelect">
							<option value="B">Selecionar Filtro</option>
							<?php while($mostrar=mysqli_fetch_row($result2)): ?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>

						<label>Descrição</label>
						<input type="text" class="form-control input-sm" id="descricao" name="descricao">
						<label>Conteúdo</label>
						<input type="file" id="imagem" name="imagem">
						<p></p>
						<span id="btnAddProduto" class="btn btn-primary">Adicionar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaProdutosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateProduto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar Produto</h4>
					</div>
					<div class="modal-body">
						<form id="frmProdutosU" enctype="multipart/form-data">
							<input type="text" id="idProduto" hidden="" name="idProduto">
							<label>Campanha</label>
							<select class="form-control input-sm" id="campanhaSelectU" name="campanhaSelectU">
								<option value="A">Selecionar Campanha</option>
								<?php 
								$sql="SELECT id_campanha,nome
								from campanhas";
								$result=mysqli_query($conexao,$sql);
								?>
								<?php while($mostrar=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
								<?php endwhile; ?>
							</select>


							<label>Filtro</label>
							<select class="form-control input-sm" id="filtroSelectU" name="filtroSelectU">
								<option value="B">Selecionar Filtro</option>
								<?php 
								$sql="SELECT id_filtro,nome_filtro
								from filtros";
								$result2=mysqli_query($conexao,$sql);
								?>
								<?php while($mostrar=mysqli_fetch_row($result2)): ?>
									<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
								<?php endwhile; ?>
							</select>

							<label>Descrição</label>
							<input type="text" class="form-control input-sm" id="descricaoU" name="descricaoU">							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAtualizarProduto" type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function addDadosProduto(idproduto){
			$.ajax({
				type:"POST",
				data:"idpro=" + idproduto,
				url:"../procedimentos/produtos/obterDados.php",
				success:function(r){
					
					dado=jQuery.parseJSON(r);
					$('#idProduto').val(dado['id_produto']);
					$('#campanhaSelectU').val(dado['id_campanha']);
					$('#filtroSelectU').val(dado['id_filtro']);
					$('#descricaoU').val(dado['descricao']);

				}
			});
		}

		function eliminarProduto(idProduto){
			alertify.confirm('Deseja Excluir este Produto?', function(){ 
				$.ajax({
					type:"POST",
					data:"idproduto=" + idProduto,
					url:"../procedimentos/produtos/eliminarProdutos.php",
					success:function(r){
						if(r==1){
							$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não Excluido :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAtualizarProduto').click(function(){

				dados=$('#frmProdutosU').serialize();
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/produtos/atualizarProdutos.php",
					success:function(r){
						if(r==1){
							$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
							alertify.success("Editado com sucesso!!");
						}else{
							alertify.error("Erro ao editar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");

			$('#btnAddProduto').click(function(){

				vazios=validarFormVazio('frmProdutos');

				if(vazios > 0){
					alertify.alert("Preencha todos os campos!!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmProdutos"));

				$.ajax({
					url: "../procedimentos/produtos/inserirProdutos.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						
						if(r == 1){
							$('#frmProdutos')[0].reset();
							$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
							alertify.success("Adicionado com sucesso!!");
						}else{
							alertify.error("Falha ao Adicionar");
						}
					}
				});
				
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>