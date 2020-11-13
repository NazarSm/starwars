<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'homeworld_id',
        'name',
        'gender',
        'height',
    ];

    public function homeworld()
    {
        return $this->belongsTo(Homeworld::class);
    }

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
