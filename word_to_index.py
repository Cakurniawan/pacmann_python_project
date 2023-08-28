google_reviews = [
    ['Aplikasinya berjalan dengan baik. Senang'],
    ['Kurang suka. Waktu loading pembayaran terlalu lama'],
    ['Butuh perbaiki loading dari aplikasi yang terlalu lama'],
    ['Cepat proses installasinya'],
    ['Kenapa tidak bisa top up bos ?'],
    ['Suka suka suka']
]


# Flatten the list of sentences and tokenize words
words = []
for review in google_reviews:
    sentence = review[0]
    tokens = sentence.split()
    for token in tokens:
        cleaned_token = token.rstrip('.').lower()
        if '?' not in cleaned_token:
            words.append(cleaned_token)

# Remove duplicates
unique_words = sorted(set(words))

# Create the word_to_index dictionary
word_to_index = {}
for index, word in enumerate(unique_words):
    word_to_index[word] = index

# Print the dictionary
print(word_to_index)
