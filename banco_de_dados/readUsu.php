<?php
include_once 'conexao.php';

$querySelect = $link->query("select a.id, nome, a.login,senha, login, email, celular, a.nivel as id_nivel, b.descricao as nivel, ativo from tb_usuarios a , tb_niveis b where a.nivel = b.id");
while ($registros = $querySelect->fetch_assoc()):
    $id = $registros['id'];
    $nome = $registros['nome'];
    $login = $registros['login'];
    $email = $registros['email'];
    $celular = $registros['celular'];
    $nivel = $registros['nivel'];
//    $ativo = $registros['ativo'];
    $ativo = ($registros['ativo'] == 1) ? "Sim" : "Não";

    // Nao será mostrada a senha 
    //c$senha = $registros['senha'];

    echo "<tr>";
    echo "<td>$nome</td>";
    echo "<td>$login</td>";
    echo "<td>$email</td>";
    echo "<td>$celular</td>";
    echo "<td>$nivel</td>";
    echo "<td>$ativo</td>";
  
  
    echo "<td><a href='editarUsu.php?id=$id'><i class='material-icons'>edit</i></td>";
    echo "<td><a href='../banco_de_dados/deleteusu.php?id=";
    echo $id."&tabela=tb_usuarios&retorno=admin.php' " ;
    echo ' OnClick="javascript:return confirm(\'Deseja mesmo excluir o usuário:\n '.$nome . ' ?\');">';
    echo "<i class='material-icons'>delete</i>";
   
    // echo " Excluir </a>";

	echo  "</td></tr>";


    echo "</tr>";
endwhile;

 ?>   