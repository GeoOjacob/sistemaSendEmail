<?php 

require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
?>


<h4>Enviar Campanha</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmEnviosProdutos">
			<label>Selecionar Audiência</label>
			<select class="form-control input-sm" id="clienteEnvio" name="clienteEnvio">
				<option value="A">Selecionar</option>
				<option value="0">Sem Audiência</option>
				<?php
				$sql="SELECT id_filtro,nome_filtro,desc_filtro 
				from filtros";
				$result=mysqli_query($conexao,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[1]." ".$cliente[2] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Campanha</label>
			<select class="form-control input-sm" id="produtoEnvio" name="produtoEnvio">
				<option value="A">Selecionar</option>
				<?php
					$sql="SELECT pro.id_produto, cam.nome
						from produtos as pro	
						inner join campanhas as cam
						on pro.id_campanha = cam.id_campanha";

				$result=mysqli_query($conexao,$sql);

				while ($produto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $produto[0] ?>"><?php echo $produto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Descrição</label>
			<textarea readonly="" id="descricaoV" name="descricaoV" class="form-control input-sm"></textarea>
			<p></p>
			<span class="btn btn-primary" id="btnAddEnvio">Adicionar</span>
			<span class="btn btn-danger" id="btnLimparEnvios">Apagar</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProduto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tabelaEnviosTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaEnviosTempLoad').load("envios/tabelaEnviosTemp.php");

		$('#produtoEnvio').change(function(){

			$.ajax({
				type:"POST",
				data:"idproduto=" + $('#produtoEnvio').val(),
				url:"../procedimentos/envios/obterDadosProdutos.php",
				success:function(r){
					dado=jQuery.parseJSON(r);

					$('#descricaoV').val(dado['descricao']);
					
					$('#imgProduto').prepend('<img class="img-thumbnail" id="imgp" src="' + dado['url'] + '" />');
					
				}
			});
		});

		$('#btnAddEnvio').click(function(){
			vazios=validarFormVazio('frmEnviosProdutos');

			if(vazios > 0){
				alertify.alert("Preencha os Campos!!");
				return false;
			}

			dados=$('#frmEnviosProdutos').serialize();
			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/envios/adicionarProdutoTemp.php",
				success:function(r){
					$('#tabelaEnviosTempLoad').load("envios/tabelaEnviosTemp.php");
				}
			});
		});

		$('#btnLimparEnvios').click(function(){

		$.ajax({
			url:"../procedimentos/envios/limparTemp.php",
			success:function(r){
				$('#tabelaEnviosTempLoad').load("envios/tabelaEnviosTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">

	function editarP(dados){
		
		$.ajax({
			type:"POST",
			data:"dados=" + dados,
			url:"../procedimentos/envios/editarEstoque.php",
			success:function(r){
				
				$('#tabelaEnviosTempLoad').load("envios/tabelaEnviosTemp.php");
				alertify.success("Estoque Atualizado com Sucesso!!");
			}
		});
	}

	function criarEnvio(){
		$.ajax({
			url:"../procedimentos/envios/criarEnvio.php",
			success:function(r){
				
				if(r > 0){
					$('#tabelaEnviosTempLoad').load("envios/tabelaEnviosTemp.php");
					$('#frmEnviosProdutos')[0].reset();
					alertify.alert("Envio Criada com Sucesso!");
				}else if(r==0){
					alertify.alert("Não possui lista de Envios");
				}else{
					alertify.error("Envio não efetuado");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteEnvio').select2();
		$('#produtoEnvio').select2();

	});
</script>