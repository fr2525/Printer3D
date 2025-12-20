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

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$_SESSION['id'] = $id;
$querySelect = $link->query("select id,cpf_cnpj,nome,email,celular from tb_clientes where id='$id'");

while ($registros = $querySelect->fetch_assoc()) :
    $id = $registros['id'];
    $cpf_cnpj  = $registros['cpf_cnpj'];
    $nome = $registros['nome'];
    $email = $registros['email'];
    $celular = $registros['celular'];
endwhile;

?>

<div class="row container">
    <form action="../banco_de_dados/updateCli.php" id="formEditarCliente" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
            <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend> -->
            <h5 class="light center">Alteração de Clientes</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>

            <!-- Campo CPF/CNPJ -->
            <div class="row">
                <div class="input-field col s3">
                    <i class="material-icons prefix">fingerprint</i>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?php echo $cpf_cnpj ?>" maxlength="20" required="" autofocus>
                    <label for="cpf_cnpj">CPF/CNPJ</label>
                </div>

                <!-- Campo Nome -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" maxlength="40" required autofocus>
                    <label for="nome">Nome do cliente</label>
                </div>
            </div>

            <!-- Campo email -->
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input type="text" name="email" id="email" value="<?php echo $email ?>" maxlength="100" required="">
                <label for="email">E-mail</label>
            </div>

            <div class="row">

                <!-- Campo Celular -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">phone</i>
                    <input type="text" name="celular" id="celular" value="<?php echo $celular ?>" maxlength="20" required="">
                    <label for="celular">Tel.Celular</label>
                </div>
            </div>

            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Alterar" class="btn blue">
                <a href="lista_clientes.php" class="btn red">Cancelar</a>
            </div>

        </fieldset>
    </form>
</div>

<?php include_once('../includes/footer.inc.php') ?>