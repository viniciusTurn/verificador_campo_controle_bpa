# verificador_campo_controle_bpa

Ferramenta para validar o **campo de controle** em arquivos de procedimentos exportados para o sistema **BPA (Boletim de Produção Ambulatorial)**.

Disponível nas linguagens: **PHP**, **Python** e **Node.js**.

## Funcionalidade

O script realiza a leitura de um arquivo de texto contendo registros de produção e:

- Identifica e soma os valores dos procedimentos BPA-C (código "02")
- Identifica e soma os valores dos procedimentos BPA-I (código "03")
- Calcula a soma total dos procedimentos
- Obtém o **resto da divisão** da soma total por `1111`
- Gera o **campo de controle** a partir dessa operação

## Como usar

1. Execute o script na linguagem desejada
2. Informe o nome do arquivo quando solicitado
3. Veja os resultados diretamente no terminal

## Requisitos

- PHP 7+, Python 3 ou Node.js 14+
- Um arquivo de entrada no formato padrão do BPA


