class Data:

    # membuat Instance attribute data dan size untuk
    # menampung inputan data, dan panjang data inputan
    data = 0
    size = 0

    # constructor method
    def __init__(self):
        pass

    # Membuat method untuk membaca data dan menyimpannya ke
    # Instance attribute self.data dan self.size agar dapat
    # diaccess oleh method lain
    def read_data(self, data):
        self.data = data
        self.size = len(self.data)

    # Membuat method untuk mencari total nilai dari deret angka pada list data
    # lalu mengembalikan nilainya pada fungsi return
    def find_total(self):
        sum_data = sum(self.data)

        return sum_data

    # Membuat method mencari rata-rata,
    # menggunakan hasil dari method find_total() yaitu total penjumlahan,
    # dibagi dengan berapa jumlah panjang nilai yang ada
    def find_average(self):
        average = self.find_total() / self.size

        return average

#########


# DO NOT CHANGE ANYTHING IN THIS CELL
# Just run after you finish the function
data = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

try:
    data_obj = Data()
    data_obj.read_data(data)

    print(data_obj.data)
    print(data_obj.size)
    print(data_obj.find_total())
    print(data_obj.find_average())
except Exception as e:
    print('There is something wrong')
