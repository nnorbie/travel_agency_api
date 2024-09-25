<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'name', 'image', 'price', 'rating'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
