<?php
include_once 'conexao.php';

$querySelect = $link->query("select id, cpf, nome, email, celular from tb_clientes");
while ($registros = $querySelect->fetch_assoc()):
    $id = $registros['id'];
    $cpf = $registros['cpf'];
    $nome = $registros['nome'];
    $email = $registros['email'];
    $celular = $registros['celular'];
  
    echo "<tr>";
    echo "<td>$cpf</td>";
    echo "<td>$nome</td>";
    echo "<td>$email</td>";
    echo "<td>$celular</td>"; 
  
    echo "<td><a href='editar.php?id=$id'><i class='material-icons'>edit</i></td>";
    echo "<td><a href='banco_de_dados/delete.php?id=$id'><i class='material-icons'>delete</i></td>";
    echo "</tr>";
endwhile;

 ?>   