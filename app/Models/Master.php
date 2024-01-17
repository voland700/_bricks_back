<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
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
    protected $appends = [
        'url'
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
        return $this->belongsTo(Master::class, 'master_id');
    }

    protected function url(): Attribute
    {
        if (!$this->master_id) {
            return Attribute::make(get: fn() => $this->slug);
        } else {
            return Attribute::make(get: fn() => $this->senior->slug);
        }
    }

    protected function getMetaTitle(): Attribute
    {
        if ($this->meta_title) {
            return Attribute::make(get: fn() => $this->meta_title);
        } else {
            return Attribute::make(get: function () {
                return 'Печник ' . $this->name . ' ' . $this->location . ' - строительсвто печей и каминов, контакты, фото - примеры выполенных работ';
            });
        }
    }

    protected function getMetaDescription(): Attribute
    {
        if ($this->meta_description) {
            return Attribute::make(get: fn() => $this->meta_description);
        } else {
            return Attribute::make(get: function () {
                $str = 'Печник ' . $this->name . ' ' . $this->location;
                if ($this->member) {
                    $str = $str . ' - Участник НП РСПК';
                }
                if ($this->brief) {
                    $str = $str . Str::length($this->brief, 100);
                } else {
                    $str = $str . 'Возведение печей, каминов, печных комплексов под ключ, монтаж отопительных и банных
                    печей, контакты и примеры выполненных работ';
                }
                return $str;
            });
        }
    }

    protected function getMetaKeywords(): Attribute
    {
        if ($this->metaKeywords) {
            return Attribute::make(get: fn() => $this->meta_keywords);
        } else {
            return Attribute::make(get: fn(
            ) => 'печник, строительство, монтаж, печи, камины, дымоходы, контакты, фото, примеры, работ, выбрать, печник, заказть'
            );
        }
    }

    protected function getMetaH1(): Attribute
    {
        if ($this->h1) {
            return Attribute::make(get: fn() => $this->h1);
        } else {
            return Attribute::make(get: function () {
                $h1 = 'Печник ' . $this->name;
                if ($this->location) {
                    $h1 = $h1 . ' ' . $this->location;
                }
                return $h1;
            });
        }
    }

}
