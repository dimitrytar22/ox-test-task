<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $clientsCount = Client::query()->count();
        $ordersCount = Order::query()->count();
        $lastOrder = Order::query()->limit(1)->orderBy('id','desc')->first();
        return view('home', compact('clientsCount', 'ordersCount', 'lastOrder'));
    }
}
