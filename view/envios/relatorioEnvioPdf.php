<?php 
	require_once "../../classes/conexao.php";
	require_once "../../classes/envios.php";

	$objv= new envios();


	$c= new conectar();
	$conexao=$c->conexao();
	$idvenda=$_GET['idenvio'];

 $sql="SELECT ve.id_envio,
		ve.dataEnvio,
		cam.nome,
        pro.descricao
	from envios  as ve 
	inner join produtos as pro
	on ve.id_produto=pro.id_produto
	inner join campanhas as cam
	on ve.id_campanha=cam.id_campanha
	and ve.id_envio='$idenvio'";

$result=mysqli_query($conexao,$sql);

	$ver=mysqli_fetch_row($result);

	$comp=$ver[0];
	$data=$ver[1];
	$idcliente=$ver[2];

 ?>	

 	

 	<link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
 
 		<img src="../../img/logo.png" width="200" height="120">
 		<br>
 		<table class="table">
 			<tr>
 				<td>Data: 
 				<?php echo date("d/m/Y", strtotime($data)) ?>
 				</td>
 			</tr>
 		</table>


 		<table class="table">
 			<tr>
 				<td>Campanhas</td>
 				<td>Preco</td>
 				<td>Quantidade de Envio</td>
 				<td>Descricao</td>
 			</tr>

			 <?php 
			 $sql="SELECT ve.id_envio,
			 			ve.dataEnvio,
			 			cam.nome,
			 			pro.descricao
					from envios  as ve 
					inner join produtos as pro
					on ve.id_produto=pro.id_produto
					inner join campanhas as cam
					on ve.id_campanha=cam.id_campanha
					and ve.id_envio='$idenvio'";

			$result=mysqli_query($conexao,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<td><?php echo $mostrar[1]; ?></td>
 				<td><?php echo $mostrar[2]; ?></td>
 				<td><?php echo $mostrar[3]; ?></td>
 			</tr>
 			<?php 

 			endwhile;
 			 ?>
 		</table>
