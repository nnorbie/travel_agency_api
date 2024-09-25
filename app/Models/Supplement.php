<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'name', 'image', 'description', 'price', 'difficulty_level'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
