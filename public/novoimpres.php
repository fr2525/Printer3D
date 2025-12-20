<?php session_start()  ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');

/* Marca
    Tipo
    cor
    qtde_estoque
    Valor
    */

if (isset($_SESSION['marca'])) :
    $marca = $_SESSION['marca'];
else :
    $marca = "";    
endif;
if (isset($_SESSION['modelo'])) :
    $modelo = $_SESSION['modelo'];
else :
    $modelo = "";    
endif;
if (isset($_SESSION['rolos'])) :
    $rolos= $_SESSION['rolos'];
else :
    $rolos = 0;    
endif;

?>

<div class="row container">
    <form action="../banco_de_dados/createimpres.php" id="formImpressora" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
          <!--  <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Cadastro de Impressoras</h5>

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
                    <input type="text" name="modelo" value="<?php echo $modelo ?>" id="tipo" maxlength="100" required="" autofocus>
                    <label for="modelo">Modelo</label>
                </div>
                
            </div>

            <div class="row">
                <!-- Campo rolos -->
                <div class="input-field col s4">
                    <input type="text" name="rolos" value="<?php echo $rolos ?>" id="rolos" maxlength="10" required="">
                    <label for="rolos">Rolos</label>
                </div>
            </div>    
            <!-- Botões -->
            <div class="input-field col s12">
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="button" value="Limpar" onclick="resetar()" class="btn red">&nbsp&nbsp
                <a href="lista_impressoras.php" class="btn purple">Voltar</a>
                
            </div>

        </fieldset>
    </form>
</div>

<?php include_once('../includes/footer.inc.php');
?>
