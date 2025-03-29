<?php

namespace App\Http\Services;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemService
{
    public function search(Request $request)
    {
        $prompt = $request->get('prompt');
        $items = Item::query()
            ->where('title', 'LIKE', "%$prompt%")->limit(50)->get();
        return $items;
    }
}
