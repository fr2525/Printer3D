<?php
include_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tabela = filter_input(INPUT_GET, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "delete from " . $tabela . " WHERE id = '$id'";

echo "sql = " . $sql ;
exit();

$queryDelete = $link->query($sql);

if (mysqli_affected_rows($link) > 0 ):
    header("Location: ../public/lista_impressoras.php");
endif;    

?>