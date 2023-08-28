class Transaction():
    """
    def __init__(self, item_name, number_of_items, price_of_items):
        self.item_name = item_name
        self.number_of_items = number_of_items
        self.price_of_items = price_of_items
    """

    def add_item(self, item_name, number_of_items, price_of_items):
        table = {
            'item_name': item_name,
            'number_of_items': number_of_items,
            'price_of_item': price_of_items
        }

        return table


trnsct_123 = Transaction()

x = trnsct_123.add_item(item_name='Silverqueen',
                        number_of_items=4, price_of_items=24_000)
print(x)
