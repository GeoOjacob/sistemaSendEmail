<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/envios.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$obj= new envios();

	$sql="SELECT id_envio,
				dataEnvio,
				id_campanha 
			from envios group by id_envio";
	$result=mysqli_query($conexao,$sql); 
	?>


<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Envios</label></caption>
				<tr>
					<td>Código</td>
					<td>Data</td>
					<td>Campanha</td>
					<td>Total de Envio</td>
					<td>Relatório</td>
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo date("d/m/Y", strtotime($ver[1])) ?></td>
					<td>CMP_TESTE</td>
					<td>10.542</td>
					<td>
						<a href="../procedimentos/envios/criarRelatorioPdf.php?idenvio=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Relatório <span class="glyphicon glyphicon-file"></span>
						</a>	
					</td>
				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>