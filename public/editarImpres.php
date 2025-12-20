<?php
session_start();
include_once '../includes/header.inc.php';
include_once '../includes/menu.inc.php';
?>

<!--
<div class="row container">
    <div class="col s12">
        <h5 class="light"> Edição de Registros </h5><hr>
    </div>    
</div>  
-->


<?php
include_once('../banco_de_dados/conexao.php');

/*
    $marca
    $tipo
    $cor
    $qtde_estoque 
    $valor 
  
*/

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$_SESSION['id'] = $id;

/*
    $sql_code = "select * from tb_usuarios where email = '$email' LIMIT 1";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    $usuario = $sql_exec->fetch_assoc();
*/

$querySelect = $link->query("select id,marca,modelo,qtrolos  from tb_impressoras where id='$id' LIMIT 1 ");


$registros = $querySelect->fetch_assoc();
$id = $registros['id'];
$marca  = $registros['marca'];
$modelo = $registros['modelo'];
$qtrolos = $registros['qtrolos'];

?>

<div class="row container">
    <form action="../banco_de_dados/updateimpres.php" id="formEditarImpres" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
            <legend><img src="imagens/avatar-1.png" width="50"></legend>
            <h5 class="light center">Alteração de impressora</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <div class="row">
                <!-- Campo marca -->
                <div class="input-field col s12">
                    <input type="text" name="marca" value="<?php echo $marca ?>" id="marca" maxlength="100" required="" autofocus>
                    <label for="marca">Marca</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo modelo -->
                <div class="input-field col s12">
                    <input type="text" name="modelo" value="<?php echo $modelo ?>" id="modelo" maxlength="100" required="" autofocus>
                    <label for="modelo">Modelo</label>
                </div>

            </div>

            <div class="row">
                <!-- Campo rolos -->
                <div class="input-field col s4">
                    <input type="text" name="qtrolos" value="<?php echo $qtrolos ?>" id="qtrolos" maxlength="10" required="">
                    <label for="qtrolos">Rolos</label>
                </div>
            </div>
            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Alterar" class="btn blue">
                <a href="lista_impressoras.php" class="btn red">Cancelar</a>
            </div>

        </fieldset>
    </form>
</div>

<?php include_once('../includes/footer.inc.php') ?>