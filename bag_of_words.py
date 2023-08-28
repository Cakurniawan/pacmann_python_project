google_reviews = [
    ['Aplikasinya berjalan dengan baik. Senang'],
    ['Kurang suka. Waktu loading pembayaran terlalu lama'],
    ['Butuh perbaiki loading dari aplikasi yang terlalu lama'],
    ['Cepat proses installasinya'],
    ['Kenapa tidak bisa top up bos?'],
    ['Suka suka suka']
]

# Flatten the list of sentences and tokenize words
words = []
for review in google_reviews:
    sentence = review[0]
    tokens = sentence.split()
    for token in tokens:
        cleaned_token = token.lower()
        words.append(cleaned_token)

# Remove duplicates
unique_words = list(set(words))

# Sort the unique words alphabetically
bag_of_words = sorted(unique_words)

# Print the bag of words
# print(bag_of_words)

# Create the word_to_index dictionary
word_to_index = {}
for index, word in enumerate(bag_of_words):
    word_to_index[word] = index

# Convert words to index numbers in the google_reviews list
indexed_reviews = []
for review in google_reviews:
    sentence = review[0]
    tokens = sentence.split()
    indexed_tokens = []
    for token in tokens:
        cleaned_token = token.lower()
        indexed_tokens.append(word_to_index[cleaned_token])
    indexed_reviews.append(indexed_tokens)

# Print the indexed reviews
# for indexed_review in indexed_reviews:
    # print(indexed_review)

# Convert index numbers back to words in the indexed_reviews list
original_reviews = []
for indexed_review in indexed_reviews:
    original_tokens = []
    for index in indexed_review:
        word = bag_of_words[index]
        original_tokens.append(word)
    original_sentence = ' '.join(original_tokens)
    original_reviews.append([original_sentence])

# Print the original reviews
for original_review in original_reviews:
    print(original_review)
