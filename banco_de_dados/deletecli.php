<?php
include_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tabela = filter_input(INPUT_GET, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS);
$retorno = filter_input(INPUT_GET, 'retorno', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "delete from " . $tabela . " WHERE id = '$id'";

//echo "retorno = " . $retorno ;
//exit();

$queryDelete = $link->query($sql);

if (mysqli_affected_rows($link) > 0 ):
    header("Location: ../public/" . $retorno);
endif;    

?>