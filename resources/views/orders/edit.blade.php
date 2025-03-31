@extends('layouts.main')

@section('title')
    Edit order
@endsection

@section('content')
    <a href="{{ url()->previous() }}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Edit Order</h1>

            <form id="order_form" action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <label for="item_search_input">Search Item</label>
                <input type="text" id="item_search_input" name="item_search"
                       class="w-full p-2 border border-gray-300 rounded-md"
                       placeholder="Enter item name to search...">

                <div id="item_results" class="mt-2"></div>

                <div id="selected_items" class="mt-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center mb-4" data-item-id="{{ $item->id }}">
                            <span class="mr-2">{{ $item->title }} ({{ $item->price }} $)</span>
                            <input type="hidden" name="items[{{ $item->id }}][item_id]" value="{{ $item->id }}">
                            <input type="number" name="items[{{ $item->id }}][quantity]"
                                   value="{{ $item->pivot->quantity }}" min="1">
                            <button type="button" class="ml-2 text-red-500 text-xl remove-item"
                                    data-item-id="{{ $item->id }}">&times;
                            </button>
                        </div>
                    @endforeach
                    @error('items')
                    <x-input-error :messages="$message"/>
                    @enderror
                    @error('items.*.*')
                    <x-input-error :messages="$message"/>
                    @enderror

                </div>

                <label for="status_id">Select status</label>
                <select name="status_id" id="status_id">
                    @foreach($statuses as $status)
                        <option value="{{$status->id}}"
                                @if($order->status_id == $status->id) selected @endif>{{$status->title}}</option>
                    @endforeach
                </select>
                @error('status_id')
                <x-input-error :messages="$message"/>
                @enderror

                <div>
                    <label for="paid_at">Select date of paying</label>
                    <input type="datetime-local" name="paid_at" value="{{$order->paid_at}}">
                </div>
                @error('paid_at')
                <x-input-error :messages="$message"/>
                @enderror
                <div>
                    <button type="submit"
                            class="w-full mt-4 p-3 text-white bg-blue-500 font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        let selectedItems = @json($order->items->map(fn($i) => ["item_id" => $i->id, "quantity" => $i->pivot->quantity]));

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
                                addItem(item.id, item.title, item.price);
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

        function addItem(itemId, title, price) {
            if (!selectedItems.some(item => item.item_id === itemId)) {
                let itemDiv = document.createElement('div');
                itemDiv.classList.add('flex', 'items-center', 'mb-4');
                itemDiv.dataset.itemId = itemId;
                itemDiv.innerHTML = `
                    <span class="mr-2">${title} (${price} $)</span>
                    <input type="hidden" name="items[${itemId}][item_id]" value="${itemId}">
                    <input type="number" name="items[${itemId}][quantity]" value="1" min="1">
                    <button type="button" class="ml-2 text-red-500 text-xl remove-item" data-item-id="${itemId}">&times;</button>
                `;
                document.getElementById('selected_items').appendChild(itemDiv);
                selectedItems.push({item_id: itemId, quantity: 1});
            }
        }

        document.getElementById('selected_items').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                let itemId = parseInt(e.target.dataset.itemId);
                selectedItems = selectedItems.filter(item => item.item_id !== itemId);
                e.target.parentElement.remove();
            }
        });

        document.getElementById('selected_items').addEventListener('input', function (e) {
            if (e.target.tagName.toLowerCase() === 'input' && e.target.type === 'number') {
                let itemId = parseInt(e.target.dataset.itemId);
                let item = selectedItems.find(item => item.item_id === itemId);
                if (item) {
                    item.quantity = parseInt(e.target.value);
                }
            }
        });

        document.getElementById('order_form').addEventListener('submit', function () {
            let inputs = document.querySelectorAll('#selected_items input');
            selectedItems = [];

            inputs.forEach(input => {
                let itemId = input.name.match(/\[(\d+)\]/)[1];
                if (input.type === 'hidden') {
                    return;
                }
                let quantity = parseInt(input.value);
                selectedItems.push({item_id: itemId, quantity: quantity});
            });

            document.getElementById('items_json').value = JSON.stringify(selectedItems);
        });
    </script>
@endsection
