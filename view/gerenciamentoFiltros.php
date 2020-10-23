<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>filtros</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Criar Filtro</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmFiltros">
						<label>Filtro</label>
						<input type="text" class="form-control input-sm" name="filtro" id="filtro">
						<label>Query</label>
						<input type="text" class="form-control input-sm" name="desc_filtro" id="desc_filtro">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarFiltro">Criar</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tabelaFiltroLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="atualizaFiltro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Filtro</h4>
					</div>
					<div class="modal-body">
						<form id="frmFiltroU">
							<input type="text" hidden="" id="idfiltro" name="idfiltro">
							<label>Filtro</label>
							<input type="text" id="filtroU" name="filtroU" class="form-control input-sm">
							<label>Query</label>
							<input type="text" id="desc_filtroU" name="desc_filtroU" class="form-control input-sm">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnAtualizaFiltro" class="btn btn-warning" data-dismiss="modal">Salvar</button>

					</div>
				</div>
			</div>
		</div>
	</body>
	</html>


<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaFiltroLoad').load("gerenciamentoFiltros/tabelaFiltros.php");

			$('#btnAdicionarFiltro').click(function(){

				vazios=validarFormVazio('frmFiltros');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmFiltros').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/gerenciamentoFiltro/adicionarFiltros.php",
					success:function(r){

						if(r==1){
							$('#frmFiltros')[0].reset();
							$('#tabelaFiltroLoad').load("gerenciamentoFiltros/tabelaFiltros.php");
							alertify.success("Filtro Adicionado");
						}else{
							alertify.error("Não foi possível adicionar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAtualizaFiltro').click(function(){

				dados=$('#frmFiltroU').serialize();
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/gerenciamentoFiltro/atualizarFiltros.php",
					success:function(r){
						if(r==1){
							$('#tabelaFiltroLoad').load("gerenciamentoFiltros/tabelaFiltros.php");
							alertify.success("Atualizado com Sucesso :)");
						}else{
							alertify.error("Não foi possível atualizar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">

	function adicionarDado(idFiltro,filtro,idDesc_filtro,desc_filtro){
		$('#idfiltro').val(idFiltro);
		$('#filtroU').val(filtro);
		$('#idDesc_filtro').val(idDesc_filtro);
		$('#desc_filtro').val(desc_filtro);
	}


		function eliminaFiltro(idfiltro){
			alertify.confirm('Deseja excluir este filtro?', function(){ 
				$.ajax({
					type:"POST",
					data:"idfiltro=" + idfiltro,
					url:"../procedimentos/gerenciamentoFiltro/eliminarFiltros.php",
					success:function(r){
						if(r==1){
							$('#tabelaFiltroLoad').load("gerenciamentoFiltros/tabelaFiltros.php");
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não Excluido");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}

	</script>




<?php 
}else{
	header("location:../index.php");
}
?>