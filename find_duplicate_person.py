people_ID = ['01', '02', '03', '04', '05', '06', '07']
people_name = [
    'Budi santoso',
    'Pramono Setiadi',
    'Rijal',
    'Dedi setiawan',
    'rijal',
    'Alesha Nur',
    'Dedi Setiawan'
]

name_to_id = {}

for i, name in enumerate(people_name):
    # print(i)
    if name in name_to_id:
        name_to_id[name].append(people_ID[i])
    else:
        name_to_id[name] = [people_ID[i]]

# print(name_to_id)

similar_names = []

for name, ids in name_to_id.items():
    # print(ids)
    # if len(ids) > 1:
    # for id in ids:
    # print(id)
    similar_names.append([ids, name])

sorted_names = sorted(similar_names)
# print(sorted_names)


name_seen = {}  # Dictionary to keep track of seen names
duplicated_data = []

for item in similar_names:
    name = item[1]
    if name in name_seen:
        duplicated_data.append(item)
    else:
        name_seen[name] = True

# print(duplicated_data)

# print(similar_names)
