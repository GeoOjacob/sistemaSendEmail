<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>envios</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

	<div class="container">
		 <h1>Envios das campanhas</h1>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<span class="btn btn-default" id="envioProdutosBtn">Enviar Campanha</span>
		 		<span class="btn btn-default" id="enviosFeitasBtn">Lista de Envios</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="envioProdutos"></div>
		 		<div id="enviosFeitas">

		 			
<?php 

	
	//require_once "vendas/vendasRelatorios.php" 

	?>

		 		</div>
		 	</div>
		 </div>
	</div>
</body>
</html>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#envioProdutosBtn').click(function(){
				esconderSessaoVenda();
				$('#envioProdutos').load('envios/enviosDeProdutos.php');
				$('#envioProdutos').show();
			});
			$('#enviosFeitasBtn').click(function(){
				esconderSessaoVenda();
				$('#enviosFeitas').load('envios/enviosRelatorios.php');
				$('#enviosFeitas').show();
			});
		});

		function esconderSessaoVenda(){
			$('#envioProdutos').hide();
			$('#enviosFeitas').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>