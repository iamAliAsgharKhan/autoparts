<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    //

    protected $fillable = ['platform_name', 'url', 'icon'];
}
