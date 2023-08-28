class Normalizer():

    # membuat construct inisialisasi
    def __init__(self):
        pass


    def fit(self, data):
        min_data = min(data)
        max_data = max(data)

        return min_data + 'min data', max_data + 'max data'

    def transform(self, data):

