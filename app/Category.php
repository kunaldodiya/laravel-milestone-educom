<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'image', 'order'
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }
}
