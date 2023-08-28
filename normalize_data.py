# Write your code here
# Note: You can write your input manually

class Normalizer:
    min = 0
    max = 0

    # membuat construct inisialisasi
    def __init__(self):

        pass

    def fit(self, data):

        min_data = min(data)
        max_data = max(data)

        self.min = min_data
        self.max = max_data

        return min_data, max_data
       # return f" min data = {min_data}, max_data = {max_data}"

    def transform(self, data):
        x_scaled = []

        for index in range(len(data)):
            min_max = (data[index] - min(data)) / (max(data) - min(data))
            x_scaled.append(min_max)

        self.data_scaled = x_scaled

        return x_scaled

    def inverse_transform(self, data):
        # data_inv_scaled = []
        # inversed_data = self.transform(x_scaled)

        initialed = []

        for index in range(len(data)):
            back_initial = (data[index] * (self.max - self.min)) + self.min
            initialed.append(back_initial)

        return initialed


# Define a data to normalize
x = [-3, -9, 0, 8, 11]

# 1. Initialize a Normalizer object
scaler = Normalizer()

# 2. Fit the data
scaler.fit(data=x)
print('min value :', scaler.min)
print('max value :', scaler.max)

# 3. Transform data
x_scaled = scaler.transform(data=x)
print('x initial    :', x)
print('x scaled     :', x_scaled)

# 4. Transform back the scaled data (Inverse)
x_inv_scaled = scaler.inverse_transform(data=x_scaled)
print('x inv scaled :', x_inv_scaled)
