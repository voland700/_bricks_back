<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Property extends Model
{
    protected $guarded = [];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('value');;
    }


    protected function definition(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->type ? $this->type->name. ' / '. $this->name : ''. $this->name
        );
    }
}
