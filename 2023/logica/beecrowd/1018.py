numero= int(input())
print(numero)
print(f"{numero//100} nota(s) de R$ 100,00")
numero%= 100
print(f"{numero//50} nota(s) de R$ 50,00")
numero%= 50
print(f"{numero//20} nota(s) de R$ 20,00")
numero%= 20
print(f"{numero//10} nota(s) de R$ 10,00")
numero%= 10
print(f"{numero//5} nota(s) de R$ 5,00")
numero%= 5
print(f"{numero//2} nota(s) de R$ 2,00")
numero%= 2
print(f"{numero} nota(s) de R$ 1,00")