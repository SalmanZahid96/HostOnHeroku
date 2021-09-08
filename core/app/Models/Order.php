<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function service()
    {
        return $this->belongsTo(Service::class)->withDefault();
    }

    //Scopes
    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 1);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 2);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 3);
    }

    public function scopeRefunded($query)
    {
        return $query->where('status', 4);
    }

    public function scopeApiorder($query)
    {
        return $query->where('api_order', 1);
    }

    public function scopeOrdernotplaced($query)
    {
        return $query->where('order_placed_to_api', 0);
    }
}
