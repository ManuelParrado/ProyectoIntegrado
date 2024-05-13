<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'capacity',
        'number'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('date', 'timeslot', 'deleted_at');
    }
}
