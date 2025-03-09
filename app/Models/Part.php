<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
  

    protected $fillable = [
        'name',
        'description',
        'price',
        'note',
        'quality',
        'stock_level',
        'main_image',
        'image_1',
        'image_2',
        'image_3',
        'make_id',
       'car_model_id',
        'year_id',
        'category_id',
    ];

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
