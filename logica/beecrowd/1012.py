a,b,c = list(map(float,input().split()))
tri = (a*c)*0.5
cir = 3.14159*c**2
tra = (a+b)*c*0.5
qdr = b**2
ret = a*b

print("TRIANGULO: %.3lf"%tri)
print("CIRCULO: %.3f"%cir)
print("TRAPEZIO: %.3f"%tra)
print("QUADRADO: %.3f"%qdr)
print("RETANGULO: %.3f"%ret)