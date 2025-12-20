<?php
include_once 'conexao.php';

$querySelect = $link->query("select id, marca, modelo,qtrolos from tb_impressoras");
while ($registros = $querySelect->fetch_assoc()):
    $id = $registros['id'];
    $marca = $registros['marca'];
    $modelo = $registros['modelo'];
    $qtrolos = $registros['qtrolos'];
 
    /*
    $marca
    $tipo
    $cor
    $qtde_estoque 
    $valor 
  
*/

    echo "<tr>";
    echo "<td>$marca</td>";
    echo "<td>$modelo</td>";
    echo "<td>$qtrolos</td>";
 
    echo "<td><a href='editarimpres.php?id=$id'><i class='material-icons'>edit</i></td>";
    echo "<td><a href='../banco_de_dados/deleteimpres.php?id=";
    echo $id."&tabela=tb_impressoras&retorno=lista_impressoras.php' " ;
    echo ' OnClick="javascript:return confirm(\'Deseja mesmo excluir a impressora \n marca: '.$marca . ' \n modelo: ' . $modelo . ' ?\');">';
    echo "<i class='material-icons'>delete</i>";
   
    // echo " Excluir </a>";

	echo  "</td></tr>";


    echo "</tr>";
endwhile;

 ?>   