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

for index, name in enumerate(people_name):
    lowercase_name = name.lower()
    if lowercase_name in name_to_id:
        name_to_id[lowercase_name].append(people_ID[index])
    else:
        name_to_id[lowercase_name] = [people_ID[index]]

print(name_to_id)

similar_names = []

for name, ids in name_to_id.items():
    # print(len(ids))
    # if len(ids) > 1:
    # for id in ids:
    similar_names.append([ids, name.capitalize()])

# print
# sorted_names = sorted(similar_names)
