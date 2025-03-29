<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Services\ItemService;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(public ItemService $service)
    {
    }

    public function search(Request $request)
    {
        $items = $this->service->search($request);
      return response()->json([
         'status' => !$items->isEmpty(),
          'items' => $items->isEmpty() ? null : ItemResource::collection($items)
      ]);
    }
}
