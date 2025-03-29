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
}
