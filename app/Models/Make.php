<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}