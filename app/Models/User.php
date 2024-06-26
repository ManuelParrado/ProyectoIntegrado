<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Livewire\WithPagination;

class User extends Authenticatable
{
    use HasFactory, Notifiable, WithPagination;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'telephone_number',
        'email',
        'password',
        'role',
        'image'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class)->withPivot('id', 'date', 'timeslot', 'deleted_at', 'created_at', 'updated_at');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
