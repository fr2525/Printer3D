<?php
session_start();
include_once 'conexao.php';
 
/*
    $marca
    $tipo
    $cor
    $qtde_estoque 
    $valor 
  
*/

$id = $_SESSION['id'];

$marca  = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_SPECIAL_CHARS);
$modelo    = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS);
$qtrolos   = filter_input(INPUT_POST, 'qtrolos', FILTER_SANITIZE_SPECIAL_CHARS);
// $valor = filter_input(INPUT_POST, 'valor',  FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

$sql = "update tb_impressoras SET marca = '$marca' ,modelo ='$modelo',qtrolos = $qtrolos
                                                    WHERE id = '$id'";

//echo "sql => " . $sql;
//exit();
     $queryUpdate = $link->query($sql);
$affected_rows = mysqli_affected_rows($link);

if ($affected_rows > 0 ):
    header("Location: ../public/lista_impressoras.php");
endif;    

?>

