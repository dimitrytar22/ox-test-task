@extends('layouts.main')

@section('title')
    Create order
@endsection

@section('content')
    <a href="{{ route('clients.orders.index', $client->id) }}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Create Order</h1>

            <form action="{{ route('clients.orders.store', $client->id) }}" method="POST" class="space-y-4">
                @csrf

                <label for="item_search_input">Search Item</label>
                <input type="text" id="item_search_input" name="item_search"
                       class="w-full p-2 border border-gray-300 rounded-md"
                       placeholder="Enter item name to search...">

                <div id="item_results" class="mt-2"></div>

                <div id="selected_items" class="mt-4">
                    <!-- Items will be appended here -->
                </div>

                <input type="hidden" name="items" id="items_json">

                <div>
                    <button type="submit"
                            class="w-full mt-4 p-3 text-white bg-blue-500 font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let selectedItems = [];

        document.getElementById('item_search_input').addEventListener('input', async function () {
            let query = this.value;

            if (query.length >= 3) {
                try {
                    const response = await fetch(`/items/search`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            prompt: query,
                            _token: document.querySelector("form input[name='_token']").value
                        })
                    });

                    if (!response.ok) throw new Error('Network response was not ok');

                    const json = await response.json();
                    let resultsContainer = document.getElementById('item_results');
                    resultsContainer.innerHTML = '';

                    if (json.status && json.items.length > 0) {
                        json.items.forEach(item => {
                            let div = document.createElement('div');
                            div.classList.add('cursor-pointer', 'p-2', 'border', 'border-gray-300', 'rounded-md', 'mb-2');
                            div.textContent = `${item.title} (${item.price} $)`;
                            div.addEventListener('click', function () {
                                let quantityInput = document.createElement('input');
                                quantityInput.type = 'number';
                                quantityInput.value = 1;
                                quantityInput.min = 1;
                                quantityInput.classList.add('w-16', 'mt-2', 'mr-2');
                                quantityInput.addEventListener('change', function () {
                                    updateItemQuantity(item.id, quantityInput.value);
                                });

                                let itemDiv = document.createElement('div');
                                itemDiv.classList.add('flex', 'items-center', 'mb-4');
                                itemDiv.textContent = `${item.title} (${item.price} $)`;

                                itemDiv.appendChild(quantityInput);
                                itemDiv.dataset.itemId = item.id;

                                let removeBtn = document.createElement('button');
                                removeBtn.innerHTML = '&times;';
                                removeBtn.classList.add('ml-2', 'text-red-500', 'text-xl');
                                removeBtn.addEventListener('click', function () {
                                    removeItem(item.id);
                                });

                                itemDiv.appendChild(removeBtn);
                                document.getElementById('selected_items').appendChild(itemDiv);

                                selectedItems.push({ item_id: item.id, quantity: 1 });
                                updateHiddenInput();
                            });
                            resultsContainer.appendChild(div);
                        });
                    } else {
                        resultsContainer.innerHTML = '<div class="p-2 text-gray-500">No items found</div>';
                    }
                } catch (error) {
                    console.error('Error fetching items:', error);
                }
            }
        });

        function updateItemQuantity(itemId, quantity) {
            const item = selectedItems.find(item => item.item_id === itemId);
            if (item) {
                item.quantity = parseInt(quantity);
                updateHiddenInput();
            }
        }

        function removeItem(itemId) {
            selectedItems = selectedItems.filter(item => item.item_id !== itemId);
            let itemDiv = document.querySelector(`[data-item-id="${itemId}"]`);
            itemDiv.remove();
            updateHiddenInput();
        }

        function updateHiddenInput() {
            // Here we update the hidden input with the selected items (array)
            document.getElementById('items_json').value = JSON.stringify(selectedItems);
        }
    </script>
@endsection
