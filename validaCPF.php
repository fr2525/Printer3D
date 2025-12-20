<?php
// Função PHP para validar CPF
function validaCPF($cpf) {

    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula e verifica o primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
        $soma += $cpf[$i] * $j;
    }
    $resto = $soma % 11;
    if ($cpf[9] != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }

    // Calcula e verifica o segundo dígito verificador
    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
        $soma += $cpf[$i] * $j;
    }
    $resto = $soma % 11;
    if ($cpf[10] != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }

    return true;
}
/*
// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    if (validaCPF($cpf)) {
        // Redireciona de volta com status de sucesso
        header('Location: index.html?status=valido');
    } else {
        // Redireciona de volta com status de erro
        header('Location: index.html?status=invalido');
    }
    exit();
}
    */
?>
