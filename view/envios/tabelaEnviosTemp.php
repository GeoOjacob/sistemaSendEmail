<?php 

	session_start();
	
 ?>

 <h4>Criar Envio</h4>
 <h4><strong><div id="nomeclienteEnvio"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 	<caption>
 		<span class="btn btn-success" onclick="criarEnvio()"> Criar Envio
 			<span class="glyphicon glyphicon-usd"></span>
 		</span>
 	</caption>
 	<tr>
 		<td>Campanha</td>
		<td>Audiência</td>
 		<td>Descrição</td>
 	</tr>
 	<?php 

 		if(isset($_SESSION['tabelaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tabelaComprasTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>

 		<td><?php echo $d[1] ?></td>
 		<td><?php echo $d[2] ?></td>
 		<td><?php echo $d[3] ?></td>
 		
 	</tr>

 <?php 
 	}
 	endif; 
 ?>

 </table>

 <script type="text/javascript">
 	$(document).ready(function(){
 		nome="<?php echo @$cliente ?>";
 		$('#nomeclienteEnvio').text("Nome de cliente: " + nome);
 	});
 </script>