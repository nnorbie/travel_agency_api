<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'image', 'description', 'price', 'duration'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function supplements()
    {
        return $this->hasMany(Supplement::class);
    }
}
