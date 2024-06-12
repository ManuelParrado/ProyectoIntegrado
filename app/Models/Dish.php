<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'image',
        'visibility_status'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'dish_order');
    }
}
