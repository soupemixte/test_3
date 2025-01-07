<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
    protected $table = 'bottle';

    protected $fillable = [

        'title',
        'price',
        'image_src',
        'saq_link',
        'country',
        'region',
        'degree_alcohol',
        'color',
        'size',
        'description',
        'designation_of_origin',
        'classification',
        'sugar_content',
        'particularity',
        'promoting_agent',
        'producer',
        'grape_variety',
        'vintage_tasted',
        'aromas',
        'created_at'
        
    ];


    public function cellars()
    {
        return $this->belongsToMany(Cellar::class, 'cellar_bottle')
            ->using(CellarBottle::class)
            ->withTimestamps();
    }

}



