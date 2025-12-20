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
$querySelect = $link->query("select id,marca,tipo,cor,qtde_estoque,valor  from tb_filamentos where id='$id'");

while ($registros = $querySelect->fetch_assoc()) :
    $id = $registros['id'];
    $marca  = $registros['marca'];
    $tipo = $registros['tipo'];
    $cor = $registros['cor'];
    $qtde_estoque = $registros['qtde_estoque'];
    $valor = $registros['valor'];
endwhile;

?>

<div class="row container">
    <form action="../banco_de_dados/updatefila.php" id="formEditarFila" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
            <legend><img src="imagens/avatar-1.png" width="50"></legend>
            <h5 class="light center">Alteração de Filamento</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <!-- Campo marca/CNPJ -->
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">fingerprint</i>
                    <input type="text" name="marca" id="marca" value="<?php echo $marca ?>" maxlength="20" required="" autofocus>
                    <label for="marca">Marca</label>
                </div>
            </div>
            <div class="row">
                <!-- Campo tipo -->
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="tipo" id="tipo" value="<?php echo $tipo ?>" maxlength="40" required autofocus>
                    <label for="tipo">Tipo do filamento</label>
                </div>
            </div>
            <div class="row">
                <!-- Campo cor -->
                <div class="input-field col s4">
                    <i class="material-icons prefix">cor</i>
                    <input type="text" name="cor" id="cor" value="<?php echo $cor ?>" maxlength="100" required="">
                    <label for="cor">Cor</label>
                </div>

                <!-- Campo qtde_estoque -->
                <div class="input-field col s4">
                    <input type="text" name="qtde_estoque" id="qtde_estoque" value="<?php echo $qtde_estoque ?>" maxlength="10" required="">
                    <label for="qtde_estoque">Estoque</label>
                </div>

                <!-- Campo Preço -->
                <div class="input-field col s4">
                    <input type="text" name="valor" id="valor" maxlength="20" required=""
                        value="<?php echo number_format($valor, 2, ',', '.'); ?>" onblur="javascript:this.value=formataValor(this.value);">

                </div>
            </div>

            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Alterar" class="btn blue">
                <a href="lista_filamentos.php" class="btn red">Cancelar</a>
            </div>

        </fieldset>
    </form>
</div>

<?php include_once('../includes/footer.inc.php') ?>