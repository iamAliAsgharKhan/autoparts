<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'description',
    ];

    /**
     * Get all images associated with the project.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    /**
     * Get only the 'before' images.
     */
    public function beforeImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class)
                    ->where('type', 'before')
                    ->orderBy('order');
    }

    /**
     * Get only the 'after' images.
     */
    public function afterImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class)
                    ->where('type', 'after')
                    ->orderBy('order');
    }
}