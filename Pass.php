<?php


$senha = "1234";

//$hash = password_hash($senha, PASSWORD_DEFAULT);

//echo $hash;

echo password_verify($senha, '$2y$12$sxhxmtVXz/IV3gJWtwUaK.jFioiwoRoG0J00EwdlELknAYKtf05l.');

/* Exemplo de processo de login

include_once 'conexao.php';

if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql_code = "select * from tb_usuarios where email = '$email' LIMIT 1";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    $usuario = $sql_exec->fetch_assoc();
    if(password_verify($senha, $usuario['senha'])) {
        echo "usuario logado";
    } else{
        echo "Senha ou e-mail inválido";
    }
}

*/