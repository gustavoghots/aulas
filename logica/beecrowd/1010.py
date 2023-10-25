itemA = input().split(' ')
itemB = input().split(' ')

total = int(itemA[1])*float(itemA[2])+int(itemB[1])*float(itemB[2])
print("VALOR A PAGAR: R$ %0.2f" %total)