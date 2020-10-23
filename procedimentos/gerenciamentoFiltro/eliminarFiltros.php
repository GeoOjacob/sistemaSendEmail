<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/gerenciamentoFiltro.php";

$id = $_POST['idfiltro'];

$obj = new gerenciamentoFiltro();
echo $obj->excluirFiltro($id);

?>