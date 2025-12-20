<?php
session_start();
include_once '../includes/header.inc.php';
include_once '../includes/menu.inc.php';
?>

<?php
include_once('../banco_de_dados/conexao.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$_SESSION['id'] = $id;
$querySelect = $link->query("select a.id, nome, login,senha,email, celular, a.nivel as id_nivel, b.descricao as nivel, ativo from tb_usuarios a , tb_niveis b where a.id='$id' and a.nivel = b.id ");

while ($registros = $querySelect->fetch_assoc()) :
    $id = $registros['id'];
    $login  = $registros['login'];
    $nome = $registros['nome'];
    $senha = $registros['senha'];
    $email = $registros['email'];
    $celular = $registros['celular'];
    $id_nivel = $registros['id_nivel'];
    $ativo = $registros['ativo'];
endwhile;

?>

<div class="row container">
    <form action="../banco_de_dados/updateUsu.php" id="formEditarUsuario" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
           <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Alteração de Usuarios</h5>

            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <div class="row">
                <!-- Campo Nome -->
                <div class="input-field col s12">

                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" maxlength="40" required autofocus>
                    <label for="nome">Nome</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo Usuario -->
                <div class="input-field col s4">

                    <input type="text" name="login" id="login" value="<?php echo $login ?>" maxlength="10" required autofocus>
                    <label for="login">Login</label>
                </div>
                <!-- Campo senha -->
                <div class="input-field col s4">
                    <i class="material-icons prefix"></i>
                    <input type="text" name="senha" id="senha" value="<?php echo $senha ?>" maxlength="20">
                    <span class="lnr lnr-eye"></span>
                    <label for="senha">senha</label>
                </div>
                <!-- Campo confirma senha -->
                <div class="input-field col s4">
                    <i class="material-icons prefix"></i>
                    <input type="text" name="confsenha" id="confsenha" value="<?php echo $senha ?>" maxlength="20">
                    <span class="lnr lnr-eye"></span>
                    <label for="confsenha">Cofirma a senha</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo email -->
                <div class="input-field col s12">
                    <input type="text" name="email" id="email" value="<?php echo $email ?>" maxlength="100" required="">
                    <label for="email">E-mail</label>
                </div>
            </div>
            <div class="row">
                <!-- Campo Celular -->
                <div class="input-field col s4">
                <input type="text" name="celular" id="celular" value="<?php echo $celular ?>" maxlength="20">
                    <label for="celular">Tel.Celular</label>
                </div>
                <!-- Campo Nivel -->
                <div class="input-field col s4">
                    <i class="material-icons prefix"></i>
                    <select name="nivel" id="nivel">
                        <?php
                        $querySelect = $link->query("select id, descricao from tb_niveis");

                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_select = $registros['id'];
                            $descricao = $registros['descricao'];
                            if ($id_nivel == $id_select) {
                                echo '<option value=' . $id_select . ' selected>' . $descricao . '</option>';
                            } else {
                                echo '<option value=' . $id_select . '>' . $descricao . '</option>';
                            }
                        endwhile;
                        echo '</select>';
                        echo '<label for="nivel">Nível?</label>';
                        ?>
                </div>

                <div class="input-field col s4">
                    <select name="ativo">
                        <option value="1" selected>SIM</option>
                        <option value="0">NÃO</option>
                    </select>
                    <label for="ativo">Ativo?</label>
                </div>
            </div>
            
                <!-- Botões -->
                <div class="input-field col s12">
                    <input type="submit" value="Alterar" class="btn blue">
                    <a href="admin.php" class="btn red">Cancelar</a>
                </div>
            
        </fieldset>
    </form>
</div>

<?php include_once('../includes/footer.inc.php') ?>