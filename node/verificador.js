const fs = require('fs');
const readline = require('readline');
const path = require('path');

// Função para ler input do terminal
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question('Digite o nome do arquivo: ', (filename) => {
  const fullPath = path.join(__dirname, filename);

  // Verifica se o arquivo existe
  if (!fs.existsSync(fullPath)) {
    console.log(`Arquivo '${filename}' não encontrado no diretório atual.`);
    rl.close();
    return;
  }

  // Lê o arquivo linha por linha
  const fileStream = fs.createReadStream(fullPath);
  const rlFile = readline.createInterface({
    input: fileStream,
    crlfDelay: Infinity
  });

  let primeiraLinhaIgnorada = false;
  let somaBpaC = 0;
  let somaBpaI = 0;

  rlFile.on('line', (line) => {
    if (!primeiraLinhaIgnorada) {
      primeiraLinhaIgnorada = true;
      return;
    }

    const header = line.slice(0, 2);

    // BPA-C
    if (header === '02') {
      const numProcedimento = parseInt(line.slice(26, 36)) || 0;
      const quantidade = parseInt(line.slice(39, 45)) || 0;
      somaBpaC += numProcedimento + quantidade;
    }

    // BPA-I
    if (header === '03') {
      const numProcedimento = parseInt(line.slice(49, 59)) || 0;
      const quantidade = parseInt(line.slice(88, 94)) || 0;
      somaBpaI += numProcedimento + quantidade;
    }
  });

  rlFile.on('close', () => {
    const somaTotal = somaBpaC + somaBpaI;
    const restoDivisao = somaTotal % 1111;
    const campoDeControle = restoDivisao + 1111;

    console.log(`A soma dos procedimentos BPA-C é: ${somaBpaC}`);
    console.log(`A soma dos procedimentos BPA-I é: ${somaBpaI}`);
    console.log(`A soma TOTAL dos procedimentos é: ${somaTotal}`);
    console.log(`O resto da divisão do valor TOTAL dos procedimentos é: ${restoDivisao}`);
    console.log(`O campo de controle deve ser: ${campoDeControle}`);

    rl.close();
  });
});

