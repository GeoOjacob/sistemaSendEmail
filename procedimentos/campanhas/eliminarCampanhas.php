<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/campanhas.php";

$id = $_POST['idCampanha'];

$obj = new campanhas();
echo $obj->excluirCampanha($id);

?>