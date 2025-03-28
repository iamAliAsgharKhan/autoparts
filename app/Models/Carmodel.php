<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = ['make_id', 'name'];

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function years()
    {
        return $this->hasMany(Year::class);
    }


    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}