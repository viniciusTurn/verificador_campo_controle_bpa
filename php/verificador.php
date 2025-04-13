<?php
// Recebe a linha final para a primeira soma a partir do terminal
$filename = readline("Digite o nome do arquivo: ");
$fullPath = __DIR__ . '/' . $filename;

if (!file_exists($fullPath)) {
    echo "Arquivo '$filename' não encontrado no diretório atual.\n";
    exit;
}

$handle = fopen($fullPath, 'r');
if (!$handle) {
    echo "Erro: o arquivo '$filename' existe, mas não pôde ser aberto (verifique permissões).\n";
    exit;
}

$somaProcedimentosBpaC = 0;
$somaProcedimentosBpaI = 0;
// Ignora a primeira linha (cabeçalho)
fgets($handle);

while (($line = fgets($handle)) !== false) {
    // Pega os dois primeiros caracteres da linha
    $headerLine = substr($line, 0, 2);

    // BPA-C
    if ($headerLine === '02') {
        // Extrai o número da posição 27 a 36
        $numberProcedimentoBpaC = (int) substr($line, 26, 10);

        // Extrai o número da posição 40 a 45
        $quantityBpaC = (int) substr($line, 39, 6);

        // Soma ambos os números
        $somaProcedimentosBpaC += $numberProcedimentoBpaC + $quantityBpaC;
    }

    // BPA-I
    if ($headerLine === '03') {
        // Extrai o número da posição 50 a 59
        $numberProcedimentoBpaI = (int) substr($line, 49, 10);

        // Extrai o número da posição 89 a 94
        $quantityBpaI = (int) substr($line, 88, 6);

        // Soma ambos os números
        $somaProcedimentosBpaI += $numberProcedimentoBpaI + $quantityBpaI;
    }
}

fclose($handle);

$somaTotal = $somaProcedimentosBpaC + $somaProcedimentosBpaI;
$restoDaDivisao = $somaTotal % 1111;
$campoDeControle = $restoDaDivisao + 1111;

echo "A soma dos procedimentos BPA-C é: $somaProcedimentosBpaC\n";
echo "A soma dos procedimentos BPA-I é: $somaProcedimentosBpaI\n";
echo "A soma TOTAL dos procedimentos é: $somaTotal\n";
echo "O resto da divisão do valor TOTAL dos procedimentos é: $restoDaDivisao\n";
echo "O campo de controle deve ser: $campoDeControle\n";
