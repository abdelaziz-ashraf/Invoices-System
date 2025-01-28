<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    function products() {
        return $this->hasMany(Product::class);
    }
}
