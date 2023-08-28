def distribute_people_equally(n, k):
    if n % k != 0:
        raise ValueError("Cannot distribute people equally among the groups.")

    group_size = [n // k] * k
    return group_size


n = 14  # Number of people
k = 3   # Number of groups

group_size = distribute_people_equally(n, k)
print(group_size)
