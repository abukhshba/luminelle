<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    protected $guarded = ['id'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews() :HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function images() :HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
