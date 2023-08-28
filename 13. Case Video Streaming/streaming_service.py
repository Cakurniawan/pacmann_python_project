# Workflow Streaming service

# Requirements Fitur

# 1. Menampilkan seluruh plan yang tersedia
# 2. Menampilkan plan yang sedang dipakai
# 3. Menampilkan harga jika:
# - User baru yang menggunakan referral code
# - User lama yang ingin upgrade plan dan memiliki duration plan > 12

# Proposed solution
# Membut object class untuk mendeskripsikn user
# New user Object tersebut memiliki:
# - Attribute:
#   Username

# - Method:
#   check_benefit, pick_plan


# Membut psuocode

# Pseudocode for each method:
# - check_benefit()
#   input: -
#   output: benefit dari masing - masing plan
#   #shows all plan benefit

# - check_plan()
#   input: username
#   output: username, current_plan, duration_plan
#   # 1. Check the user current_plan
#   # 2. Print the benefit according to user current_plan

# - upgrade_plan()
#   input:
#   username, current_plan, new_plan
#   output:
#   harga final, akan mendapatkan potongan jika duration_plan > 12 bulan
#   # 1. input new_plan
#   # 2. check if new_plan >= current_plan
#   #    a. if not raise error "cannot downgrade"
#   # 3. calculate the price to pay
#   #    a. check if current duration_plan > 12 months
#   #       1. if yes discount = 5%, else discount = 0%
#   #    b. calculate final price -> final_price = plan_price * (plan_price - discount)
#   # 4. Shows the final_price on the screen

# - pick_plan()
#   input: new_plan, referral_code
#   output: harga final yang sudah dipotong dengan referral_code
#   # 1. input new_plan nd referral_code
#   # 2. check if referral_code exist in data,
#   #    a. if not exist. raise error "referrk code doesn't exist"
#   #    b. if exist, print message "referral code exist"
#   # 3. calculate the price to pay
#   #    a. check i referral_code exist discount = 4%, else discount = 0%
#   #    b. calculate final price -> final_price = plan_price * (plan_price - discount)
#   # 4. Shows the final_price on the screen

# import library Tabulate
from tabulate import tabulate

# tinggal di run saja
data = {
    "Shandy": ["Basic Plan", 12, "shandy-2134"],
    "Cahya": ["Standard Plan", 24, "cahya-abcd"],
    "Ana": ["Premium Plan", 5, "ana-2f9g"],
    "Bagus": ["Basic Plan", 11, "bagus-9f92"]
}

data_username = data['Shandy'][2]
data_duration = data['Shandy'][1]
data_plan = data['Shandy'][0]
# print(tabulate(data, headers="keys"))

# for index, value in data.items():
# print(value)


class User():
    # username_obj = []
    # duration_obj = 0
    # current_plan_obj = []

    def username(self, username):
        self.username_obj = username[0]
        # return username

    def duration_plan(self, username):
        self.duration_obj = username[1]
        # return duration

    def current_plan(self, username):
        self.current_plan_obj = username[2]
        # return current_plan


x = "Shandy", 12, "Basic Plan"

user_1 = User()

user_1.username(x)
user_1.duration_plan(x)
user_1.current_plan(x)
print(f"{user_1.username_obj} {user_1.duration_obj} {user_1.current_plan_obj}")
print('')
