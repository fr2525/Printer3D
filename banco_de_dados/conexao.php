<?php

//include_once 'conexao.class.php';

$utf8 = header("Content-Type: text/html; charset=utf-8");

// Dev
 $db_host = 'localhost:3306'; // servidor
 $db_user = 'root'; // usuario do banco
 $db_pass = 'oyster'; // senha do usuario do banco
 $db_name = 'db_printer3d'; // nome do banco

$link = new mysqli($db_host, $db_user,$db_pass, $db_name);
// Prod
//@$link = new mysqli('localhost','140301','Lorenzzo2017','140301');
/* check connection */
if ($link->connect_error > 0) {
    die("Conexão falhou"); // Conexao falhou banco não existe: Criando o banco
}

$link->set_charset('utf8');
//echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
//die "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

//mysqli_close($link);