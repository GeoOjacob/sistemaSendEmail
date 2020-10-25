<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>campanhas</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Gerenciamento de Campanhas</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCampanhas">
						<label>Nome Campanha</label>
						<input type="text" class="form-control input-sm" name="campanha" id="campanha">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarCampanha">Criar</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tabelaCampanhaLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="atualizaCampanha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Campanha</h4>
					</div>
					<div class="modal-body">
						<form id="frmCampanhaU">
							<input type="text" hidden="" id="idcampanha" name="idcampanha">
							<label>Campanha</label>
							<input type="text" id="campanhaU" name="campanhaU" class="form-control input-sm">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnAtualizaCampanha" class="btn btn-warning" data-dismiss="modal">Salvar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaCampanhaLoad').load("campanhas/tabelaCampanhas.php");

			$('#btnAdicionarCampanha').click(function(){

				vazios=validarFormVazio('frmCampanhas');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmCampanhas').serialize();
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/campanhas/adicionarCampanhas.php",
					success:function(r){
						
						if(r==1){
					//limpar formulário
					$('#frmCampanhas')[0].reset();

					$('#tabelaCampanhaLoad').load("campanhas/tabelaCampanhas.php");
					alertify.success("Campanha adicionada com sucesso!");
				}else{
					alertify.error("Não foi possível adicionar essa campanha");
				}
			}
		});
			});
		});
	</script>




	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAtualizaCampanha').click(function(){

				dados=$('#frmCampanhaU').serialize();
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/campanhas/atualizarCampanhas.php",
					success:function(r){
						if(r==1){
							$('#tabelaCampanhaLoad').load("campanhas/tabelaCampanhas.php");
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

		function adicionarDado(idCampanha,campanha){
			$('#idcampanha').val(idCampanha);
			$('#campanhaU').val(campanha);
		}


		function eliminaCampanha(idCampanha){
			alertify.confirm('Deseja excluir esta campanha?', function(){ 
				$.ajax({
					type:"POST",
					data:"idCampanha=" + idCampanha,
					url:"../procedimentos/campanhas/eliminarCampanhas.php",
					success:function(r){
						if(r==1){
							$('#tabelaCampanhaLoad').load("campanhas/tabelaCampanhas.php");
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