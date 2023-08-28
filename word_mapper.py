class Mapper:

    bag_of_words = []
    word_to_index = {}

    sentence_list_transformed = []
    # membuat construct method

    def __init__(self):
        pass

    # membuat method fit
    def fit(self, sentence_list):

        words = []

        for review in sentence_list:
            sentence = review[0]
            tokens = sentence.split()

            for token in tokens:
                cleaned_token = token.lower()
                words.append(cleaned_token)

        # Remove duplicates
        rm_dup_words = list(set(words))

        # Sort the unique words alphabetically
        sorted_words = sorted(rm_dup_words)
        self.bag_of_words = sorted_words

        # membuat word_to_index didalam dictionary
        # fungsi enumerate adalah untuk menghasilkan pasangan index dan nilai
        # kata-kata sebagai key dan index sebagai nilai
        word_index = {}
        for index, word in enumerate(sorted_words):
            word_index[word] = index

        self.word_to_index = word_index
        # return word_to_index

    def transform(self, sentence_list):
        # Convert words to index numbers in the google_reviews list
        # Melakukan transform dari kata2 ke index yang ada pada word_to_index
        indexed_reviews = []

        for review in sentence_list:
            sentence = review[0]
            tokens = sentence.split()
            indexed_tokens = []

            for token in tokens:
                cleaned_token = token.lower()
                indexed_tokens.append(self.word_to_index[cleaned_token])

            indexed_reviews.append(indexed_tokens)

        self.sentence_list_transformed.append(indexed_reviews)

        return indexed_reviews

    def inverse_transform(self, sentence_list_number):

        original_reviews = []

        # melakukan iterasi pada list sentence_list_number utk mengubah kembali ke kata asli
        for indexed_review in sentence_list_number:
            original_tokens = []

            for index in indexed_review:
                word = self.bag_of_words[index]
                original_tokens.append(word)

            # lalu menambahkan spasi dan di joinkan ke original_tokens dan mengembalikan nilai
            # ke object original_reviews = []
            original_sentence = ' '.join(original_tokens)
            original_reviews.append(original_sentence)

        return original_reviews


# Google review comments
google_reviews = [
    ['Aplikasinya berjalan dengan baik. Senang'],
    ['Kurang suka. Waktu loading pembayaran terlalu lama'],
    ['Butuh perbaiki loading dari aplikasi yang terlalu lama'],
    ['Cepat proses installasinya'],
    ['Kenapa tidak bisa top up bos?'],
    ['Suka suka suka']
]

map_obj = Mapper()

# Fit the mapper
map_obj.fit(sentence_list=google_reviews)
print('Bag of Words:')
print(map_obj.bag_of_words)
print('')
print('Word to Index:')
print(map_obj.word_to_index)
print('')

# Transform the reviews
reviews_transformed = map_obj.transform(sentence_list=google_reviews)
print('Transformed reviews:')
print(reviews_transformed)
print('')


# Inverse transform the transformed reviews
reviews_inv_transformed = map_obj.inverse_transform(
    sentence_list_number=reviews_transformed)
print('Inverse transformed reviews:')
print(reviews_inv_transformed)
print('')
