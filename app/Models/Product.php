<?php

namespace App\Models;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'category_id'
    ];

    //relationships
    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
