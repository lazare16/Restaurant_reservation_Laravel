<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    'table_number',
    'reservation_date',
    'reservation_time',
    'number_of_guests',
    'special_request',
    'status',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_reservation')->withPivot('quantity');
    }
}
