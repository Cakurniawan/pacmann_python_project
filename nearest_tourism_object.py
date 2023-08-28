# DO NOT CHANGE THE NAME & INPUT OF THE FUNCTION
def find_nearest(current_coor, tourism_coor, tourism_name):
    '''
    Function to find nearest tourism object near current coordinates

    Parameters
    ----------
    current_coor : list
        The guest current coordinate

    tourism_coor : list
        The tourism object coordinates

    toursim_name : list
        The tourism object name

    Returns
    -------
    nearest_object : dict
        The dictionary of nearest tourism object
    '''
    distances = []

    for point in tourism_coor:
        squared_diff_x = (point[0] - current_coor[0]) ** 2
        squared_diff_y = (point[1] - current_coor[1]) ** 2
        distance = (squared_diff_x + squared_diff_y) ** 0.5
        distances.append(distance)

    min_distance = min(distances)
    min_index = distances.index(min_distance)
    nearest_object = {
        'object': str(tourism_name[min_index]),
        'dist': min_distance
    }

    return nearest_object


# DO NOT CHANGE ANYTHING IN THIS CELL
# Just run after you finish the function
tourism_name = [
    'Pantai A',
    'Jembatan B',
    'Taman C',
    'Danau D',
    'Perpustakaan E',
    'Mall F',
    'Monumen G',
    'Taman Hutan H',
    'Air terjun I',
    'Gunung J'
]

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

current_coor = [-2.21, 3.15]

nearest_object = find_nearest(current_coor, tourism_coor, tourism_name)
print(nearest_object)
