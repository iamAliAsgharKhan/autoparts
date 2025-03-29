<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image_path',
        'type',
        'order',
    ];

    /**
     * The table associated with the model.
     * Explicitly defining, although likely inferred correctly.
     */
    protected $table = 'project_images';

    /**
     * Get the project that owns the image.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}