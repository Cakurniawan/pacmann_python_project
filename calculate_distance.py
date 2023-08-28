tourism_coor = [
    [-34.93, -31.23],
    [-77.90, 79.90],
    [46.67, 40.44],
    [21.83, 1.94],
    [41.77, -63.44],
    [-1.10, -47.22],
    [68.81, 64.65],
    [-21.23, 22.03],
    [68.30, -69.73],
    [12.82, 30.75],
]

distances = []

    for point in tourism_coor:
        squared_diff_x = (point[0] - current_coor[0]) ** 2
        squared_diff_y = (point[1] - current_coor[1]) ** 2
        distance = (squared_diff_x + squared_diff_y) ** 0.5
        distances.append(distance)

print(distances)
