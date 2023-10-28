n1,n2,n3,n4=list(map(float,input().split()))
media = (n1*2+n2*3+n3*4+n4)/10
print("Media: %0.1f"%media)
if media >= 7 :
    print("Aluno aprovado.")
elif media >= 5 :
    print("Aluno em exame.")
    exame = float(input())
    print("Nota do exame: %0.1f"%exame)
    media = (media+exame)/2
    if media >= 5 :
        print("Aluno aprovado.")
    else :
        print("Aluno reprovado.")
    print("Media final: %0.1f"%media)
else :
    print("Aluno reprovado.")