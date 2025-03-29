<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'status_id',
        'paid_at',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_order')
            ->withPivot('quantity');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
