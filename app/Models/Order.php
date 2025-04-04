<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
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

    public function sum(): string
    {
        return number_format($this->items->sum(function ($item) {
            return $item->price * $item->pivot->quantity;
        }));
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

}
