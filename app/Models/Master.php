<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Master extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'masters';
    protected $fillable = [
        'name',
        'slug',
        'title',
        'active',
        'sort',
        'main',
        'master_id',
        'email',
        'phone',
        'member',
        'whatsapp',
        'participant',
        'document',
        'brief',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile()
            ->useFallbackUrl('/images/src/no-main-photo.jpg')
            ->useFallbackPath(public_path('/images/src/no-main-photo.jpg'));

        $this->addMediaCollection('small-photo')
            ->singleFile()
            ->useFallbackUrl('/images/src/no-master-prev.jpg')
            ->useFallbackPath(public_path('/images/src/no-master-prev.jpg'));
        $this->addMediaCollection('diploma');
        $this->addMediaCollection('example');

    }

    public function masters()
    {
        return $this->hasMany(Master::class);
    }

    public function childrenMasters()
    {
        return $this->hasMany(Master::class)->with('masters');
    }

    public function senior(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'master_id', 'id');
    }

}
