user_ID = ['01', '02', '03', '04', '05', '06', '07']
promo_A_status = [1, 0, 0, 1, 1, 0, 1]
promo_B_status = [0, 0, 1, 1, 0, 1, 1]

double_promo = []

for index in range(len(user_ID)):
    if promo_A_status[index] == 1 and promo_B_status[index] == 1:
        double_promo.append(user_ID[index])
        print(f"User {user_ID[index]} mendapatkan 2 Promo")
    if promo_A_status[index] == 1:
        print(f"User {user_ID[index]} mendapatkan Promo A")
    if promo_B_status[index] == 1:
        print(f"User {user_ID[index]} mendapatkan Promo B")

print(double_promo)
