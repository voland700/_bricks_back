<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'products';
    protected $guarded = [];
    protected $casts = [
        'properties' => 'array',
        'video' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useFallbackUrl('/images/src/no-main-photo.jpg')
            ->useFallbackPath(public_path('/images/src/no-main-photo.jpg'))
            ->registerMediaConversions(
                function () {
                    $this
                        ->addMediaConversion('miniature')
                        ->crop('crop-center', 100, 100);
                });

        $this->addMediaCollection('prev')
            ->singleFile()
            ->useFallbackUrl('/images/src/no-prev-photo.jpg')
            ->useFallbackPath(public_path('/images/src/no-prev-photo.jpg'));

        $this->addMediaCollection('more')
            ->registerMediaConversions(
                function () {
                    $this
                        ->addMediaConversion('thumb')
                        ->crop('crop-center', 100, 100);
                });
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }

    public function brands(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function advantages(): BelongsToMany
    {
        return $this->belongsToMany(Advantage::class);
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

}
