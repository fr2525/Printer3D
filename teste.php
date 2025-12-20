<?php
echo "Primeiro programa";
echo "Site funcionando";

$datacompra = "01/12/2025";
$datacompra = data_user_para_mysql($datacompra);
echo $datacompra;
exit();

?>
<html>

<head>

</head>

<body>
	<div class="row container">
		<form action="banco_de_dados/createusu.php" id="formUsuario" method="post" class="col s12">
			<fieldset class="formulario" style="padding: 15px">
				<!-- <legend><img src="imagens/avatar-1.png" width="50"></legend>  -->
				<h5 class="light center">Cadastro de Usuários</h5>
				<div class="row">

					<div class="input-field col s4">
						<select name="nomeCombox1" id="nomeCombox1" class="select">
							<option value="0" selected="selected">Selecione box1</option>
						</select>
					</div>
				</div>
		</form>
</body>

</html>
<?php 
function data_user_para_mysql($y)
{
	if (isset($y) && !empty($y)) {
	} else {
		$y = date("d/m/Y");

	}
	$data_inverter = explode("/", $y);
	$x = $data_inverter[2] . '-' . $data_inverter[1] . '-' . $data_inverter[0];
	return $x;
}