<?php session_start()  ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once('../includes/header.inc.php');
include_once('../includes/menu.inc.php');
include_once '../banco_de_dados/conexao.php';

$nome = "";
$login = "";
$email = "";
$celular = "";
$senha = "";
$confsenha = "";
$id_nivel = "2";
$ativo = "SIM";

?>

<div class="row container">
    <form action="../banco_de_dados/createusu.php" id="formUsuario" method="post" class="col s12">
        <fieldset class="formulario" style="padding: 15px">
            <!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
            <h5 class="light center">Cadastro de Usuários/operadores</h5>
            <?php
            if (isset($_SESSION['msg'])) :
                echo $_SESSION['msg'];
                session_unset();
            endif;
            ?>
            <div class="row">
                <!-- Campo Nome -->
                <div class="input-field col s12">
                <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="nome" value="<?php echo $nome ?>" id="nome" maxlength="40" required="" autofocus>
                    <label for="nome">Nome </label>
                </div>
            </div>

            <div class="row">
                <!-- Campo Login -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="login" value="<?php echo $login ?>" id="login" maxlength="10" required="" autofocus>
                    <label for="login">Login</label>
                </div>
                <!-- Campos senha -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="password" name="senha" value="<?php echo $senha ?>" id="senha" maxlength="10" required="">
                    <span class="lnr lnr-eye"></span>
                    <label for="senha">Senha</label>
                </div>
                <!-- Campo confirma senha -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="password" name="confsenha" value="<?php echo $confsenha ?>" id="confsenha" maxlength="10" required="">
                    <span class="lnr lnr-eye"></span>
                    <label for="confsenha">Confirme a senha</label>
                </div>

            </div>

            <div class="row">
                <!-- Campo email -->
                <div class="input-field col s12">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="email" value="<?php echo $email ?>" id="email" maxlength="100" required="">
                    <label for="email">E-mail</label>
                </div>
            </div>
            
            <div class="row">
                <!-- Campo Celular -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <input type="text" name="celular" value="<?php echo $celular ?>" id="celular" maxlength="20">
                    <label for="celular">Celular</label>
                </div>
                <!-- Campo Nivel -->
                <div class="input-field col s4">
                    <!--    <i class="material-icons prefix"></i>   -->
                    <select name="nivel" id="nivel" >
                        <option  disabled>Escolha o nível</option>
                        <?php
                        $querySelect = $link->query("select id, descricao from tb_niveis");
                        while ($registros = $querySelect->fetch_assoc()) :
                            $id_nivel = $registros['id'];
                            $nivel = $registros['descricao'];
                            echo '<option value=' . $id_nivel . '>' . $nivel . '</option>';
                            
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
                <input type="submit" value="Cadastrar" class="btn blue">&nbsp&nbsp
                <input type="button" value="Limpar" onclick="resetar()" class="btn red">&nbsp&nbsp
                <a href="admin.php" class="btn purple">Voltar</a>
            </div>

        </fieldset>
    </form>
</div>

<script>
    function resetar() {
        var form = document.getElementById("formUsuario");
        var cpf = form.cpf.value;

        var set = confirm("Deseja apagar os dados do formulário?");
        if (set) {
            //alert('Os campos do formulário foram resetados!');
            form.reset();
            form.nome.focus();
        }
    }
</script>

<?php include_once('../includes/footer.inc.php');  ?>