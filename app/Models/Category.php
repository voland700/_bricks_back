<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia, NodeTrait;
    protected $table = 'categories';
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category')
            ->singleFile();
        $this->addMediaCollection('category_icon')
            ->singleFile();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
