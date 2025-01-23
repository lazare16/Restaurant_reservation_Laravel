<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price',
    ];

    // Relationship with Reservation (if menus are part of reservations)
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'menu_reservation')->withPivot('quantity');
    }
}
