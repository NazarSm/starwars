<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'height',
        'homeworld_id',
        'film_id'
    ];

    public function homeworld()
    {
        return $this->belongsTo(Homeworld::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
