import math
A = float(input())
B = float(input())
resto = int(math.sqrt(A) % math.sqrt(B))
print(resto+1)