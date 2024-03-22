<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    protected $guarded = [];
    protected $table = 'advantages';

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
