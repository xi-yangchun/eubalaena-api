import random
def gen_rand_strs(n):
    la=[i for i in range(48,58)]
    lb=[i for i in range(65,91)]
    lc=[i for i in range(97,123)]
    l=la+lb+lc
    s=""
    for i in range(n):
        s=s+chr(l[random.randint(0,len(l)-1)])
    return s