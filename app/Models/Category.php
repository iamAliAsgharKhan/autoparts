<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image'];


     // Automatically generate a slug when saving a category
     public static function boot()
     {
         parent::boot();
 
         static::creating(function ($category) {
             $category->slug = Str::slug($category->name);
         });
 
         static::updating(function ($category) {
             $category->slug = Str::slug($category->name);
         });
     }

    // Relationship to Parts
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}