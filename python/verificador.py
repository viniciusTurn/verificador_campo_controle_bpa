import os

# Recebe o nome do arquivo via terminal
filename = input("Digite o nome do arquivo: ")
full_path = os.path.join(os.path.dirname(__file__), filename)

# Verifica se o arquivo existe
if not os.path.exists(full_path):
    print(f"Arquivo '{filename}' não encontrado no diretório atual.")
    exit()

try:
    with open(full_path, 'r') as file:
        soma_procedimentos_bpac = 0
        soma_procedimentos_bpai = 0

        # Ignora a primeira linha (cabeçalho)
        next(file)

        for line in file:
            header_line = line[0:2]

            # BPA-C
            if header_line == '02':
                number_procedimento_bpac = int(line[26:36])
                quantity_bpac = int(line[39:45])
                soma_procedimentos_bpac += number_procedimento_bpac + quantity_bpac

            # BPA-I
            if header_line == '03':
                number_procedimento_bpai = int(line[49:59])
                quantity_bpai = int(line[88:94])
                soma_procedimentos_bpai += number_procedimento_bpai + quantity_bpai

except IOError:
    print(f"Erro: o arquivo '{filename}' existe, mas não pôde ser aberto (verifique permissões).")
    exit()

# Cálculos finais
soma_total = soma_procedimentos_bpac + soma_procedimentos_bpai
resto_da_divisao = soma_total % 1111
campo_de_controle = resto_da_divisao + 1111

# Exibição dos resultados
print(f"A soma dos procedimentos BPA-C é: {soma_procedimentos_bpac}")
print(f"A soma dos procedimentos BPA-I é: {soma_procedimentos_bpai}")
print(f"A soma TOTAL dos procedimentos é: {soma_total}")
print(f"O resto da divisão do valor TOTAL dos procedimentos é: {resto_da_divisao}")
print(f"O campo de controle deve ser: {campo_de_controle}")

