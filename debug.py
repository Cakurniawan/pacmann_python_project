import math


def nll(actual, predicted_proba):
    '''return the negative loglikelihood. Return NLL (float)'''
    N = len(actual)
    nll_sum = 0.0
    for i in range(N):
        nll_sum += actual[i] * math.log(predicted_proba[i]) + \
            (1 - actual[i]) * math.log(1 - predicted_proba[i])
    nll = -(1/N) * nll_sum
    return nll


# Input
actual = [1, 0, 0, 1, 1]
predicted_proba = [0.9, 0.1, 0.05, 0.8, 0.7]

res = nll(actual, predicted_proba)
print(res)
