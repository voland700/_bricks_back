<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
        'name',
        'active',
        'sort',
        'button',
        'link',
        'text',
        'img'
    ];
    protected function url(): Attribute
    {
        if($this->link && $this->button == 1){
            return Attribute::make(get: fn() => $this->link);
        } else {
            return Attribute::make(get: fn() => false);
        }
    }
}
