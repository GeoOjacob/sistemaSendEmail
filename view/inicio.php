
<?php 
	session_start();
	if(isset($_SESSION['usuario'])){


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Início</title>
	<?php require_once "menu.php" ?>
</head>
<body>
<div class="container">
	<h1 style="color: #41413e;"> Plataforma de e-mail Marketing</h1>
        <p style="color: #0066ff; font-size: 26px;">
		Automação de Marketing.
        </p>
        <p>
		Nossa ferramenta de automação, o Send E-mail é uma plataforma baseada em nuvem que disponibiliza envios relevantes e personalizadas em canais de e-amils, permitindo que os profissionais de marketing enviem a mensagem certa, no momento certo, em todas as fases do relacionamento com o cliente.
		</p>
		
		<p>
		A automação de marketing é a utilização de ferramentas e soluções movidas pelas novas tecnologias digitais para automatizar todos os processos de marketing digital, eliminado tarefas manuais que geram muitos esforços e permitindo o monitoramento de todas as ações que geram pontos de contato.

		Ela é uma aliada que ajuda os times marketing a ordenar prioridades e focar nas estratégias e insights que realmente importam, com agilidade e eficiência. As tecnologias digitais possibilitaram o avanço da automação de marketing que, por sua vez, abriu caminho para que as empresas pudessem se focar cada vez mais na jornada do cliente.

		Tudo isso de forma personalizada para que clientes com diferentes interesses sejam impactados de forma ideal para chegar a um mesmo objetivo final: fechar mais negócios.
        </p>
<center>
		<img class="img-responsive logo img-thumbnail" src="../img/inicio.jpeg" alt="" width="350px" height="150px"></a>
</center>
</body>
</div>
</html>


<?php 
} else{
	header("location:../index.php");
}

 ?>
